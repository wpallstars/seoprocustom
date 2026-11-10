<?php
/**
 * SEO Pro Stack Custom admin loader.
 *
 * Loads the settings screen (and on multisite its network screen), the
 * Read Me tab and the Plugins screen notes for replaced plugins, then the
 * plugin's own admin parts (SEOProStackCustom_Setup::admin()). Included from the
 * main plugin file for admin requests only.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 * SPDX-FileCopyrightText: 2026 Marcus Quinn
 * Additional terms (GPL-3.0 section 7(b)): ATTRIBUTION.txt
 * Provenance: wpas-e4502af0f07e8a92. Copies, even of part, keep these lines.
 *
 * @package SEOProStackCustom
 */

if (!defined('ABSPATH')) {
    exit;
}

$seoprostackcustom_admin_files = array(
    'admin/data/readme.php',
    'admin/includes/class-settings-manager.php',
    'admin/includes/class-readme-manager.php',
    'admin/includes/class-admin-page.php',
    'admin/includes/class-admin-manager.php',
    'admin/includes/class-network-manager.php',
    'admin/includes/class-replaced-plugins.php',
);

foreach ($seoprostackcustom_admin_files as $seoprostackcustom_file) {
    require_once SEOPROSTACKCUSTOM_DIR . $seoprostackcustom_file;
}
unset($seoprostackcustom_admin_files, $seoprostackcustom_file);

SEOProStackCustom_Admin_Manager::init();
SEOProStackCustom_Network_Manager::init();
SEOProStackCustom_Replaced_Plugins::init();
SEOProStackCustom_Setup::admin();
