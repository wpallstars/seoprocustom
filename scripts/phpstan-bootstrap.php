<?php
/**
 * Constants for PHPStan (phpstan.neon.dist). WordPress's functions and
 * classes come from szepeviktor/phpstan-wordpress; this adds the constants
 * WordPress defines while it loads (wp-settings.php, wp-config.php) and
 * those seoprostackcustom.php defines.
 *
 * SPDX-License-Identifier: GPL-3.0-or-later
 * SPDX-FileCopyrightText: 2026 Marcus Quinn
 * Additional terms (GPL-3.0 section 7(b)): ATTRIBUTION.txt
 * Provenance: wpas-e4502af0f07e8a92. Copies, even of part, keep these lines.
 *
 * @package SEOProStackCustom
 */

define('WPINC', 'wp-includes');
define('COOKIEPATH', '/');
define('SITECOOKIEPATH', '/');
define('DB_NAME', 'wordpress');
define('SEOPROSTACKCUSTOM_VERSION', '0.0.0');
define('SEOPROSTACKCUSTOM_FILE', dirname(__DIR__) . '/seoprostackcustom.php');
define('SEOPROSTACKCUSTOM_DIR', dirname(__DIR__) . '/');
define('SEOPROSTACKCUSTOM_URL', 'https://example.com/wp-content/plugins/seoprostackcustom/');
