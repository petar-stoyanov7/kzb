<?php
/**
 * Register Menus
 *
 * @package KZBPress
 * @since 0.0.1
 */

register_nav_menus(
    [
        'desktop-nav'   => esc_html__('Main Desktop Navigation', 'kzbpress'),
        'mobile-nav'    => esc_html__('Mobile Navigation', 'kzbpress'),
        'footer-nav'    => esc_html__('Footer Navigation', 'kzbpress'),
    ]
);

if (!function_exists('kzb_desktop_nav')) {
    function kzb_desktop_nav()
    {
        wp_nav_menu(
            [
                'container'         => false,
                'menu-class'        => 'kzb-desktop-menu',
                'items_wrap'        => '<ul id="%1$s" class="%2$ds">%3$s</ul>',
                'theme_location'    => 'desktop-nav',
                'depth'             => 3
            ]
        );
    }
}

if (!function_exists('kzb_mobile_nav')) {
    function kzb_mobile_nav()
    {
        wp_nav_menu(
            [
                'container'         => false,
                'menu-class'        => 'kzb-mobile-menu',
                'items_wrap'        => '<ul id="%1$s" class="%2$ds">%3$s</ul>',
                'theme_location'    => 'mobile-nav',
                'depth'             => 3
            ]
        );
    }
}

if (!function_exists('kzb_footer_nav')) {
    function kzb_footer_nav()
    {
        wp_nav_menu(
            [
                'container'         => false,
                'menu-class'        => 'kzb-footer-menu',
                'items_wrap'        => '<ul id="%1$s" class="%2$ds">%3$s</ul>',
                'theme_location'    => 'footer-nav',
                'depth'             => 3
            ]
        );
    }
}