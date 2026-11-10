<?php
/**
 * Settings screen: the Customisations card on the first tab, listing each
 * customisation file and what became of it on this site.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 * SPDX-FileCopyrightText: 2026 Marcus Quinn
 * Additional terms (GPL-3.0 section 7(b)): ATTRIBUTION.txt
 * Provenance: wpas-9508a2221415b8ce. Copies, even of part, keep these lines.
 *
 * @package SEOProCustom
 * @since 0.1.1
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * The Customisations card and its style.
 */
final class SEOProCustom_Customizations_Admin {

    /**
     * Register the card and its style.
     */
    public static function register() {
        add_action('seoprocustom_settings_tab_after', array(__CLASS__, 'render_card'));
        add_action('seoprocustom_admin_enqueue', array(__CLASS__, 'enqueue_style'));
    }

    /**
     * Whether a tab is the first one, where the card goes.
     *
     * @param string $tab Tab slug.
     * @return bool
     */
    private static function is_first_tab($tab) {
        $tabs = array_keys(SEOProCustom_Setup::settings_tabs());
        return $tabs && (string) $tab === (string) $tabs[0];
    }

    /**
     * Style for the card, on the settings screen only. The core stylesheet is
     * the starter's, so this rides on it as inline CSS, using its variables so
     * dark mode follows. It also hides the starter's "No settings yet"
     * placeholder, as this card is the tab's content.
     *
     * @param string $tab Tab slug.
     */
    public static function enqueue_style($tab) {
        if (is_network_admin() || !self::is_first_tab($tab)) {
            return;
        }
        wp_add_inline_style(
            'seoprocustom-admin',
            '.spc-section > .spc-empty{display:none}'
            . '.spc-customisations{margin-block-start:12px}'
            . '.spc-customisations__card{padding:16px 20px}'
            . '.spc-customisations__card h3{margin:0 0 8px}'
            . '.spc-customisations__card p{margin:0 0 12px;color:var(--spc-muted)}'
            . '.spc-customisations__card p:last-child{margin-bottom:0}'
            . '.spc-customisations__card .widefat{margin-block-start:4px}'
        );
    }

    /**
     * The card, after the first tab's cards.
     *
     * @param string $tab Tab slug.
     */
    public static function render_card($tab) {
        if (!self::is_first_tab($tab)) {
            return;
        }
        $entries = SEOProCustom_Customizations::entries();
        ?>
        <div class="spc-cards spc-customisations">
            <div class="spc-card spc-customisations__card">
                <h3><?php esc_html_e('Customisations', 'seoprocustom'); ?></h3>
                <p class="spc-customisations__intro">
                    <?php
                    printf(
                        /* translators: 1: folder name in code tags, 2: link to the Read Me tab */
                        esc_html__('Your own changes go in %1$s, one file each, in your fork of this plugin. %2$s explains how.', 'seoprocustom'),
                        '<code>customizations/</code>',
                        '<a href="' . esc_url(SEOProCustom_Admin_Manager::tab_url('readme')) . '">' . esc_html__('The Read Me tab', 'seoprocustom') . '</a>'
                    );
                    ?>
                </p>
                <?php if (!$entries) : ?>
                    <p><?php esc_html_e('No customisation files yet.', 'seoprocustom'); ?></p>
                <?php else : ?>
                    <table class="widefat striped">
                        <thead>
                            <tr>
                                <th><?php esc_html_e('File', 'seoprocustom'); ?></th>
                                <th><?php esc_html_e('State', 'seoprocustom'); ?></th>
                                <th><?php esc_html_e('Details', 'seoprocustom'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($entries as $entry) : ?>
                                <tr>
                                    <td><code><?php echo esc_html($entry['file']); ?></code></td>
                                    <td><?php echo esc_html(SEOProCustom_Customizations::state_label($entry['state'])); ?></td>
                                    <td>
                                        <?php echo esc_html('' !== $entry['reason'] ? $entry['reason'] : $entry['description']); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}
