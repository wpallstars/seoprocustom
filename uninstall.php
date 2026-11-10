<?php
/**
 * Remove SEO Pro Custom's settings and caches on uninstall (every site on
 * multisite). Add every option, post meta, user meta, transient, cron hook
 * and file a feature stores (STANDARDS.md → Structure).
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 * SPDX-FileCopyrightText: 2026 Marcus Quinn
 * Additional terms (GPL-3.0 section 7(b)): ATTRIBUTION.txt
 * Provenance: wpas-9508a2221415b8ce. Copies, even of part, keep these lines.
 *
 * @package SEOProCustom
 */

if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

/**
 * Delete the plugin's options and transients for the current site.
 */
function seoprocustom_uninstall_site() {
    global $wpdb;

    delete_option('seoprocustom_options');
    delete_option('seoprocustom_options_lock');
    delete_option('seoprocustom_db_version');
    delete_option('seoprocustom_network_seen');
    // The network option's save lock (main site only), if a save stopped.
    delete_option('seoprocustom_network_lock');

    // This plugin's problem reports (the shared wpallstars reports); other
    // plugins' and themes' stay, and the option goes with the last report.
    $reports = get_option('wpallstars_reports');
    if (is_array($reports)) {
        $slug    = dirname(plugin_basename(__FILE__));
        $reports = array_filter($reports, function ($report) use ($slug) {
            return !is_array($report) || !isset($report['product']) || $report['product'] !== $slug;
        });
        if ($reports) {
            update_option('wpallstars_reports', $reports, false);
        } else {
            delete_option('wpallstars_reports');
        }
    }

    $patterns = array('_transient_seoprocustom_', '_transient_timeout_seoprocustom_');
    foreach ($patterns as $pattern) {
        // phpcs:ignore WordPress.DB.DirectDatabaseQuery -- one-off cleanup of our transients.
        $wpdb->query($wpdb->prepare("DELETE FROM {$wpdb->options} WHERE option_name LIKE %s", $wpdb->esc_like($pattern) . '%'));
    }
}

if (is_multisite()) {
    foreach (get_sites(array('fields' => 'ids', 'number' => 0)) as $seoprocustom_site_id) {
        switch_to_blog($seoprocustom_site_id);
        seoprocustom_uninstall_site();
        restore_current_blog();
    }
    // The network screen's settings (SEOProCustom_Network_Settings).
    delete_site_option('seoprocustom_network');
} else {
    seoprocustom_uninstall_site();
}

// Hidden "SEO Pro Custom can do the job of these plugins" lines.
delete_metadata('user', 0, 'seoprocustom_replaced_plugins_hidden', '', true);

require_once __DIR__ . '/admin/includes/class-admin-theme.php';
SEOProCustom_Admin_Theme::uninstall();

// Latest GitHub releases (the shared GitHub updater). Only a cache: another
// plugin's copy asks again.
delete_site_transient('wpallstars_github_releases');
