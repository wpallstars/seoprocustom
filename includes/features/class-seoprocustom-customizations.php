<?php
/**
 * Customisation loader: loads this site's own changes from customizations/,
 * one file at a time, and reports what each file did.
 *
 * Each customizations/{name}.php starts with a comment header:
 *
 * - Description: what the file does and why.
 * - Sites:       all (the default), or comma-separated blog IDs or hosts.
 * - Requires:    comma-separated plugin folders or theme stylesheets, each
 *                with an optional version test ("name >= 1.2.3"). Not met:
 *                the file is skipped. "never" is never met.
 * - Upstream:    the address of the request that would make the file
 *                unnecessary.
 * - Retire-When: the same syntax as Requires. Met: upstream now does the job,
 *                so the file is no longer loaded and can be deleted.
 *
 * Optional {name}.css and {name}.js next to the file load on the front end,
 * after the theme's styles, when the file is loaded.
 *
 * Each file ends in one of four states: loaded, skipped (not for this site,
 * or a requirement is not met), retired, or failed (a PHP error). A failed
 * file is reported and skipped; it never stops the site. Files load on
 * `init` (priority 0): hook `init` or later, not plugins_loaded.
 *
 * With no files, the loader reads the folder and does nothing else: no
 * output and no database queries.
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

final class SEOProCustom_Customizations extends SEOProCustom_Feature {

    const STATE_LOADED  = 'loaded';
    const STATE_SKIPPED = 'skipped';
    const STATE_RETIRED = 'retired';
    const STATE_FAILED  = 'failed';

    /** Transient holding the syntax checks, by file name (see syntax_error()). */
    const LINT_CACHE = 'seoprocustom_lint';

    /**
     * Results of loading, by file name; null before the files are loaded.
     *
     * @var array<string,array<string,mixed>>|null
     */
    private static $entries = null;

    /**
     * Versions of active plugins and the theme, by slug (see installed_version()).
     *
     * @var array<string,string|null>
     */
    private static $versions = array();

    /**
     * Syntax checks, by file name: array(mtime, size, error).
     *
     * @var array<string,array>|null
     */
    private static $lint = null;

    /** Whether a syntax check was added to self::$lint. @var bool */
    private static $lint_changed = false;

    /**
     * The folder of the customisations.
     *
     * @return string With a trailing slash.
     */
    public static function directory() {
        return SEOPROCUSTOM_DIR . 'customizations/';
    }

    /**
     * Load the files and register the reports and assets.
     */
    public static function boot() {
        self::load_files();
        add_action('wp_enqueue_scripts', array(__CLASS__, 'enqueue_assets'), 100);
        add_filter('site_status_tests', array(__CLASS__, 'site_health_tests'));
        if (is_admin()) {
            require_once __DIR__ . '/class-seoprocustom-customizations-admin.php';
            SEOProCustom_Customizations_Admin::register();
        }
        if (defined('WP_CLI') && WP_CLI) {
            require_once __DIR__ . '/class-seoprocustom-customizations-cli.php';
            SEOProCustom_Customizations_CLI::register();
        }
    }

    /**
     * Each customisation file and what became of it.
     *
     * @return array<string,array<string,mixed>> File name => name, file,
     *         state, reason, description, sites, requires, upstream, retire_when.
     */
    public static function entries() {
        self::load_files();
        return (array) self::$entries;
    }

    /**
     * Load every customisation once.
     */
    private static function load_files() {
        if (null !== self::$entries) {
            return;
        }
        self::$entries = array();
        $files         = glob(self::directory() . '*.php');
        if (!is_array($files) || !$files) {
            return;
        }
        sort($files);
        foreach ($files as $path) {
            $file = basename($path);
            if ('index.php' === $file || !preg_match('/^[A-Za-z0-9._-]+\.php$/', $file)) {
                continue;
            }
            self::$entries[$file] = self::load_file($path);
        }
        self::save_lint();
    }

    /**
     * Check one file and load it when it applies to this site.
     *
     * @param string $path Full path.
     * @return array<string,mixed>
     */
    private static function load_file($path) {
        $headers = get_file_data($path, array(
            'description' => 'Description',
            'sites'       => 'Sites',
            'requires'    => 'Requires',
            'upstream'    => 'Upstream',
            'retire_when' => 'Retire-When',
        ));
        $entry   = array_merge($headers, array(
            'name'   => basename($path, '.php'),
            'file'   => basename($path),
            'state'  => self::STATE_LOADED,
            'reason' => '',
        ));

        $why = '';
        if (!self::for_this_site($headers['sites'])) {
            return self::finish($entry, self::STATE_SKIPPED, __('Not for this site (Sites:).', 'seoprocustom'));
        }
        if ('' !== trim($headers['retire_when']) && self::conditions_met($headers['retire_when'], $why)) {
            return self::finish($entry, self::STATE_RETIRED, __('Upstream now does this; delete the file.', 'seoprocustom'));
        }
        if ('' !== trim($headers['requires']) && !self::conditions_met($headers['requires'], $why)) {
            /* translators: %s: the requirement that is not met, such as "kadence >= 1.2". */
            return self::finish($entry, self::STATE_SKIPPED, sprintf(__('Requirement not met: %s', 'seoprocustom'), $why));
        }

        $error = self::syntax_error($path);
        if ('' === $error) {
            $error = self::include_file($path);
        }
        if ('' !== $error) {
            /* translators: %s: the PHP error message. */
            return self::finish($entry, self::STATE_FAILED, sprintf(__('Skipped, PHP error: %s', 'seoprocustom'), $error));
        }
        return $entry;
    }

    /**
     * Set the state and reason of an entry.
     *
     * @param array<string,mixed> $entry  Entry.
     * @param string              $state  State.
     * @param string              $reason Reason.
     * @return array<string,mixed>
     */
    private static function finish(array $entry, $state, $reason) {
        $entry['state']  = $state;
        $entry['reason'] = $reason;
        return $entry;
    }

    /**
     * Include a file where its variables stay its own.
     *
     * @param string $path Full path.
     * @return string An error message, or '' when it loaded.
     */
    private static function include_file($path) {
        try {
            include_once $path;
        } catch (Throwable $e) {
            return $e->getMessage() . ' (line ' . $e->getLine() . ')';
        }
        return '';
    }

    /**
     * Whether a Sites: header covers this site.
     *
     * @param string $sites all, or comma-separated blog IDs or hosts.
     * @return bool
     */
    private static function for_this_site($sites) {
        $sites = strtolower(trim($sites));
        if ('' === $sites || 'all' === $sites) {
            return true;
        }
        $host = strtolower((string) wp_parse_url(home_url(), PHP_URL_HOST));
        $id   = (string) get_current_blog_id();
        foreach (array_map('trim', explode(',', $sites)) as $site) {
            if ('' !== $site && ($site === $id || $site === $host)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Whether every condition of a Requires: or Retire-When: header is met.
     *
     * @param string $spec Comma-separated "name" or "name >= version".
     * @param string $why  Receives the first condition that is not met.
     * @return bool
     */
    private static function conditions_met($spec, &$why) {
        $why = '';
        foreach (explode(',', $spec) as $condition) {
            $condition = trim($condition);
            if ('' === $condition) {
                continue;
            }
            if (!self::condition_met($condition)) {
                $why = $condition;
                return false;
            }
        }
        return true;
    }

    /**
     * Whether one condition is met.
     *
     * @param string $condition "name" or "name >= version".
     * @return bool
     */
    private static function condition_met($condition) {
        if (!preg_match('/^([A-Za-z0-9._\/-]+)\s*(?:(>=|<=|==|!=|<>|>|<|=)\s*([0-9][0-9A-Za-z.+-]*))?$/', $condition, $m)) {
            return false;
        }
        if ('never' === strtolower($m[1]) && !isset($m[2])) {
            return false;
        }
        $version = self::installed_version($m[1]);
        if (null === $version) {
            return false;
        }
        if (empty($m[2]) || !isset($m[3])) {
            return true;
        }
        $operator = '=' === $m[2] ? '==' : $m[2];
        return (bool) version_compare($version, $m[3], $operator);
    }

    /**
     * Version of an active plugin (by folder name) or of the active theme or
     * its parent (by stylesheet).
     *
     * @param string $slug Plugin folder or theme stylesheet.
     * @return string|null Null when it is not active.
     */
    private static function installed_version($slug) {
        if (array_key_exists($slug, self::$versions)) {
            return self::$versions[$slug];
        }
        $version = null;
        $active  = self::active_plugins();
        if (isset($active[$slug])) {
            $data    = get_file_data(WP_PLUGIN_DIR . '/' . $active[$slug], array('Version' => 'Version'), 'plugin');
            $version = (string) $data['Version'];
        } elseif ($slug === get_stylesheet() || $slug === get_template()) {
            $theme = wp_get_theme($slug);
            if ($theme->exists()) {
                $version = (string) $theme->get('Version');
            }
        }
        self::$versions[$slug] = $version;
        return $version;
    }

    /**
     * The syntax error in a file, if any, without running it.
     *
     * The check works where php -l cannot run: the tokenizer parses the file
     * and throws ParseError. The result is kept by file time and size, so an
     * unchanged file is parsed once.
     *
     * @param string $path Full path.
     * @return string The error message, or '' when the syntax is right.
     */
    private static function syntax_error($path) {
        if (null === self::$lint) {
            $cached     = get_transient(self::LINT_CACHE);
            self::$lint = is_array($cached) ? $cached : array();
        }
        $file  = basename($path);
        $mtime = (int) filemtime($path);
        $size  = (int) filesize($path);
        if (isset(self::$lint[$file]) && self::$lint[$file][0] === $mtime && self::$lint[$file][1] === $size) {
            return (string) self::$lint[$file][2];
        }
        $code = file_get_contents($path); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- a local plugin file.
        if (false === $code) {
            return __('The file cannot be read.', 'seoprocustom');
        }
        $error = '';
        try {
            $tokens = token_get_all($code, TOKEN_PARSE);
            unset($tokens);
        } catch (ParseError $e) {
            $error = $e->getMessage() . ' (line ' . $e->getLine() . ')';
        }
        self::$lint[$file] = array($mtime, $size, $error);
        self::$lint_changed = true;
        return $error;
    }

    /**
     * Keep the syntax checks of the files that exist, when they changed.
     */
    private static function save_lint() {
        if (!self::$lint_changed || null === self::$lint) {
            return;
        }
        self::$lint         = array_intersect_key(self::$lint, (array) self::$entries);
        self::$lint_changed = false;
        // With an expiry, so the option is not loaded on every request.
        set_transient(self::LINT_CACHE, self::$lint, MONTH_IN_SECONDS);
    }

    /**
     * Load the style and script next to each loaded file.
     */
    public static function enqueue_assets() {
        /**
         * Filter the style handles that customisation styles load after. The
         * ones that are not registered are left out.
         *
         * @param string[] $handles Style handles; the PSD child theme's `site-design` by default.
         */
        $handles = (array) apply_filters('seoprocustom_customization_style_deps', array('site-design'));
        $deps    = array_values(array_filter($handles, function ($handle) {
            return wp_style_is((string) $handle, 'registered');
        }));
        foreach (self::entries() as $entry) {
            if (self::STATE_LOADED !== $entry['state']) {
                continue;
            }
            self::enqueue_asset($entry['name'], 'css', $deps);
            self::enqueue_asset($entry['name'], 'js', array());
        }
    }

    /**
     * Enqueue {name}.css or {name}.js when it exists.
     *
     * @param string   $name Customisation name.
     * @param string   $type css or js.
     * @param string[] $deps Handles to load after.
     */
    private static function enqueue_asset($name, $type, array $deps) {
        $path = self::directory() . $name . '.' . $type;
        if (!is_file($path)) {
            return;
        }
        $handle = 'seoprocustom-' . sanitize_key($name);
        $url    = plugins_url('customizations/' . $name . '.' . $type, SEOPROCUSTOM_FILE);
        if ('css' === $type) {
            wp_enqueue_style($handle, $url, $deps, (string) filemtime($path));
        } else {
            wp_enqueue_script($handle, $url, array(), (string) filemtime($path), true);
        }
    }

    /**
     * Label of a state.
     *
     * @param string $state State.
     * @return string
     */
    public static function state_label($state) {
        $labels = array(
            self::STATE_LOADED  => __('Loaded', 'seoprocustom'),
            self::STATE_SKIPPED => __('Skipped', 'seoprocustom'),
            self::STATE_RETIRED => __('Retired', 'seoprocustom'),
            self::STATE_FAILED  => __('Failed', 'seoprocustom'),
        );
        return isset($labels[$state]) ? $labels[$state] : (string) $state;
    }

    /**
     * Add the Site Health test.
     *
     * @param array $tests Tests.
     * @return array
     */
    public static function site_health_tests($tests) {
        $tests = (array) $tests;
        if (!isset($tests['direct'])) {
            $tests['direct'] = array();
        }
        $tests['direct']['seoprocustom_customizations'] = array(
            'label' => __('SEO Pro Custom customisations', 'seoprocustom'),
            'test'  => array(__CLASS__, 'site_health_test'),
        );
        return $tests;
    }

    /**
     * Site Health test: each customisation and its state.
     *
     * @return array
     */
    public static function site_health_test() {
        $entries = self::entries();
        $counts  = array_count_values(wp_list_pluck($entries, 'state'));
        $failed  = isset($counts[self::STATE_FAILED]) ? $counts[self::STATE_FAILED] : 0;
        $retired = isset($counts[self::STATE_RETIRED]) ? $counts[self::STATE_RETIRED] : 0;

        $result = array(
            'label'       => __('Every customisation loaded or skipped as intended', 'seoprocustom'),
            'status'      => 'good',
            'badge'       => array('label' => __('SEO Pro Custom', 'seoprocustom'), 'color' => 'blue'),
            'description' => '',
            'actions'     => '',
            'test'        => 'seoprocustom_customizations',
        );
        if (!$entries) {
            $result['description'] = '<p>' . esc_html__('There are no customisation files in the customizations folder.', 'seoprocustom') . '</p>';
            return $result;
        }
        if ($failed) {
            $result['label']  = __('A customisation has a PHP error and was skipped', 'seoprocustom');
            $result['status'] = 'critical';
        } elseif ($retired) {
            $result['label']  = __('A customisation is retired: upstream now does this', 'seoprocustom');
            $result['status'] = 'recommended';
        }
        $result['description'] = self::list_html($entries);
        return $result;
    }

    /**
     * HTML list of the customisations, for Site Health.
     *
     * @param array $entries Entries.
     * @return string
     */
    private static function list_html(array $entries) {
        $html = '<ul>';
        foreach ($entries as $entry) {
            $html .= '<li><strong>' . esc_html($entry['file']) . '</strong>: ' . esc_html(self::state_label($entry['state']));
            if ('' !== $entry['reason']) {
                $html .= ' (' . esc_html($entry['reason']) . ')';
            }
            $html .= '</li>';
        }
        return $html . '</ul>';
    }
}
