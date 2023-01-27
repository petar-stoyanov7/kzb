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
    <div class="kzb-header__desktop">
        <?php kzb_desktop_nav(); ?>
    </div>
    <div class="kzb-header__mobile">
        <div class="kzb-header__mobile-container">
            <div class="mobile-menu">
                <a href="#" class="mobile-menu__activator" id="mobile-activator"></a>
                <div class="mobile-menu__menu" id="menu-container">
                    <?php kzb_mobile_nav(); ?>
                </div>
            </div>
        </div>
    </div>
</header>