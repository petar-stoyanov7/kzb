<?php
/**
 * Register theme support
 */

add_action('after_setup_theme', 'kzbpress_theme_support');
function kzbpress_theme_support()
{
    add_theme_support(
        'html5',
        [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption'
        ]
    );

    add_theme_support('menus');

    add_theme_support('title-tag');

    add_theme_support('post-thumbnails');

    add_theme_support('editor/styles');

    add_editor_style('dist/css/editor.css');
}
