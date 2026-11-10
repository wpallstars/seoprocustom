<?php
/**
 * Example customisation. It is switched off: "Requires: never" is never met,
 * so the loader skips this file. Copy it to a new name, change the headers
 * and remove the Requires line (or give it a real requirement).
 *
 * Description: Shows a filter and a style next to it. Replace this with what your file does and why.
 * Sites:       all
 * Requires:    never
 * Upstream:    https://github.com/wpallstars/seoprocustom/issues/2
 * Retire-When: some-plugin >= 99.0
 *
 * @package SEOProCustom
 */

if (!defined('ABSPATH')) {
    exit;
}

/*
 * Change a result with a documented filter. Do not write options, theme mods
 * or database rows while this file loads. example.css, next to this file,
 * loads on the front end after the theme's styles.
 */
add_filter('excerpt_length', function () {
    return 30;
});
