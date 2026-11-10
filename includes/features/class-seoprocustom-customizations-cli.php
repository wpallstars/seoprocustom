<?php
/**
 * `wp seoprocustom list`: each customisation file and its state, for checking
 * a fleet of sites.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 * SPDX-FileCopyrightText: 2026 Marcus Quinn
 * Additional terms (GPL-3.0 section 7(b)): ATTRIBUTION.txt
 * Provenance: wpas-9508a2221415b8ce. Copies, even of part, keep these lines.
 *
 * @package SEOProCustom
 * @since 0.1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * List the customisations of this site.
 */
final class SEOProCustom_Customizations_CLI {

    /**
     * Register the command.
     */
    public static function register() {
        WP_CLI::add_command('seoprocustom', __CLASS__);
    }

    /**
     * List the customisation files and their state: loaded, skipped (not for
     * this site, or a requirement is not met), retired (upstream now does
     * this; delete the file) or failed (a PHP error).
     *
     * ## OPTIONS
     *
     * [--format=<format>]
     * : table, json, csv, yaml or count.
     * ---
     * default: table
     * ---
     *
     * ## EXAMPLES
     *
     *     wp seoprocustom list
     *     wp seoprocustom list --format=json
     *
     * @subcommand list
     *
     * @param array $args       Positional arguments.
     * @param array $assoc_args Options.
     */
    public function list_($args, $assoc_args) {
        unset($args);
        $rows = array();
        foreach (SEOProCustom_Customizations::entries() as $entry) {
            $rows[] = array(
                'file'        => $entry['file'],
                'state'       => $entry['state'],
                'reason'      => $entry['reason'],
                'description' => $entry['description'],
                'upstream'    => $entry['upstream'],
            );
        }
        $format = isset($assoc_args['format']) ? (string) $assoc_args['format'] : 'table';
        WP_CLI\Utils\format_items($format, $rows, array('file', 'state', 'reason', 'description', 'upstream'));
    }
}
