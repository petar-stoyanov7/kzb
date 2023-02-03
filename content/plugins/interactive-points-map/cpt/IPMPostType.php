<?php

/**
 * Helper for the CPT
 *
 * @since      0.0.1
 *
 * @package    IPM
 * @subpackage IPM/CPT
 */

namespace IPM\CPT;

use IPM\Helpers\IPMConfigHelper;

class IPMPostType
{
    protected array $config;


    public function __construct()
    {
        $cfg = IPMConfigHelper::getCptSettings();
        if (!$cfg) {
            return;
        }

        $this->config = $cfg;

        add_action('init', [$this, 'init']);
    }

    public function init()
    {
        if (empty($this->config)) {
            return;
        }
        $conf = $this->config;

        $labels = [
            'name'                  => _x($conf['name'], 'Post Type General Name', 'ipm'),
            'singular_name'         => _x($conf['singular'], 'Post Type Singular Name', 'ipm'),
            'menu_name'             => __($conf['menu_name'], 'ipm'),
            'name_admin_bar'        => __($conf['menu_name'], 'ipm'),
            'archives'              => __($conf['menu_name'], 'ipm'),
            'attributes'            => __('Item Attributes', 'ipm'),
            'parent_item_colon'     => __('Parent Item:', 'ipm'),
            'all_items'             => __($conf['all_items'], 'ipm'),
            'add_new_item'          => __($conf['add_new_item'], 'ipm'),
            'add_new'               => __($conf['add_new_item'], 'ipm'),
            'new_item'              => __($conf['new_item'], 'ipm'),
            'edit_item'             => __($conf['edit_item'], 'ipm'),
            'update_item'           => __($conf['update_item'], 'ipm'),
            'view_item'             => __($conf['view_item'], 'ipm'),
            'view_items'            => __($conf['view_items'], 'ipm'),
            'search_items'          => __($conf['search_items'], 'ipm'),
            'not_found'             => __($conf['not_found'], 'ipm'),
            'not_found_in_trash'    => __('Not found in Trash', 'ipm'),
            'featured_image'        => __($conf['featured_image'], 'ipm'),
            'set_featured_image'    => __($conf['set_featured_image'], 'ipm'),
            'remove_featured_image' => __($conf['remove_featured_image'], 'ipm'),
            'use_featured_image'    => __($conf['use_featured_image'], 'ipm'),
            'insert_into_item'      => __($conf['insert_into_item'], 'ipm'),
            'uploaded_to_this_item' => __($conf['uploaded_to_item'], 'ipm'),
            'items_list'            => __($conf['items_list'], 'ipm'),
            'items_list_navigation' => __($conf['items_list_nav'], 'ipm'),
            'filter_items_list'     => __($conf['items_list_filter'], 'ipm'),
        ];
        $args = [
            'label'                 => __('Пункт', 'ipm'),
            'description'           => __('Пунктове за капачки', 'ipm'),
            'labels'                => $labels,
            'supports'              => ['title', 'editor', 'thumbnail', 'revisions', 'custom-fields'],
            'taxonomies'            => [$conf['taxonomy']],
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => $conf['show_ui'],
            'show_in_menu'          => $conf['show_menu'],
            'menu_position'         => (int)$conf['menu_position'],
            'show_in_admin_bar'     => $conf['show_admin_bar'],
            'show_in_nav_menus'     => $conf['show_menu'],
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
        ];

        register_post_type($conf['slug'], $args);
    }
}
