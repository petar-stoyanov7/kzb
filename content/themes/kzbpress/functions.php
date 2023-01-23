<?php
/**
 * KZBPress functions, additions and definitions
 *
 * @package KZBPress
 * @since 0.0.1
 */

define('THEME_JSON', json_decode(file_get_contents(__DIR__ . "/theme.json"), true));

/** Navigation */
require_once 'lib/nav.php';

/** Scripts */
require_once 'lib/enqueue-scripts.php';

/** Custom Post Types */
require_once 'lib/add-cpt.php';

/** Custom Taxonomies */
require_once 'lib/add-tax.php';

/** Theme Support */
require_once 'lib/theme-support.php';

/** Custom theme Gutenberg blocks */
require_once 'lib/blocks/index.php';