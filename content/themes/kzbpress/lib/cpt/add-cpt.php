<?php
/** Register Custom Post Types here */
function points_cpt() {

    $labels = [
        'name'                  => _x( 'Пунктове', 'Post Type General Name', 'kzbpress' ),
        'singular_name'         => _x( 'Пункт', 'Post Type Singular Name', 'kzbpress' ),
        'menu_name'             => __( 'Пунктове', 'kzbpress' ),
        'name_admin_bar'        => __( 'Пунктове', 'kzbpress' ),
        'archives'              => __( 'Пунктове', 'kzbpress' ),
        'attributes'            => __( 'Item Attributes', 'kzbpress' ),
        'parent_item_colon'     => __( 'Parent Item:', 'kzbpress' ),
        'all_items'             => __( 'Всички Пунктове', 'kzbpress' ),
        'add_new_item'          => __( 'Нов Пункт', 'kzbpress' ),
        'add_new'               => __( 'Добави Нов', 'kzbpress' ),
        'new_item'              => __( 'Нов Пункт', 'kzbpress' ),
        'edit_item'             => __( 'Редактирай Пункт', 'kzbpress' ),
        'update_item'           => __( 'Обнови Пункт', 'kzbpress' ),
        'view_item'             => __( 'Виж Пункт', 'kzbpress' ),
        'view_items'            => __( 'Виж Пунктове', 'kzbpress' ),
        'search_items'          => __( 'Търси Пунктове', 'kzbpress' ),
        'not_found'             => __( 'Not found', 'kzbpress' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'kzbpress' ),
        'featured_image'        => __( 'Картинка', 'kzbpress' ),
        'set_featured_image'    => __( 'Сложи Картинка', 'kzbpress' ),
        'remove_featured_image' => __( 'Премахни Картинка', 'kzbpress' ),
        'use_featured_image'    => __( 'Използвай Картинка', 'kzbpress' ),
        'insert_into_item'      => __( 'Добави', 'kzbpress' ),
        'uploaded_to_this_item' => __( 'Добавено', 'kzbpress' ),
        'items_list'            => __( 'Списък', 'kzbpress' ),
        'items_list_navigation' => __( 'Навигация списък', 'kzbpress' ),
        'filter_items_list'     => __( 'Филтрирай', 'kzbpress' ),
    ];
    $args = [
        'label'                 => __( 'Пункт', 'kzbpress' ),
        'description'           => __( 'Пунктове за капачки', 'kzbpress' ),
        'labels'                => $labels,
        'supports'              => ['title', 'editor', 'thumbnail', 'revisions', 'custom-fields'],
        'taxonomies'            => ['point_locations'],
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
    ];

    register_post_type('points', $args);
}

add_action('init', 'points_cpt', 0);