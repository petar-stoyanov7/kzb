<?php

/**
 * The template for displaying the header
 *
 * Displays all the head elements, scripts, styles and everything up until the "container" div.
 *
 * @package KZBPress
 * @since KZBPress 0.0.1
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="kzb-header" role="banner">
    <?php //TODO: Add header navigation ?>
</header>