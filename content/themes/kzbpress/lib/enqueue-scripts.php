<?php
/**
 * Enqueue all scripts and styles
 *
 * @package KZBPress
 * @since KZBPress 0.0.1
 */

function kzb_scripts_styles()
{
    $css_data = include get_stylesheet_directory() . '/dist/css/style.asset.php';
    $js_data = include get_stylesheet_directory() . '/dist/js/app.asset.php';

    /* Main Style */
    wp_enqueue_style(
        'kzb-styles',
        get_stylesheet_directory_uri() . '/dist/css/style.css',
        $css_data['dependencies'],
        $css_data['version'],
        'all'
    );

    //Remove WP jQuery and replace
    wp_deregister_script('jquery');
    wp_enqueue_script(
        'jquery',
        'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js',
        [],
        '3.6.0',
        false
    );

    //Remove bundled jQuery migrate
    wp_deregister_script('jquery-migrate');

    /* Main Scripts */
    wp_enqueue_script(
        'kzb-scripts',
        get_stylesheet_directory_uri() . '/dist/js/app.js',
        $js_data['dependencies'],
        $js_data['version'],
        true
    );
}
add_action('wp_enqueue_scripts', 'kzb_scripts_styles');

function kzb_admin_scripts()
{
    $js_assets = include get_stylesheet_directory() . '/dist/js/admin.asset.php';
	wp_enqueue_script(
        'js_admin_script',
        get_stylesheet_directory_uri() . '/dist/js/admin.js',
        $js_assets["dependencies"],
        $js_assets["version"],
        true
    );
}
add_action('admin_enqueue_scripts', 'kzb_admin_scripts');