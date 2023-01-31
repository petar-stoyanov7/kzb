<?php
/**
 * Register custom taxonomies here
 */
function locations_tax() {

    $labels = array(
        'name'                       => _x( 'Локации', 'Taxonomy General Name', 'kzbpress' ),
        'singular_name'              => _x( 'Локация', 'Taxonomy Singular Name', 'kzbpress' ),
        'menu_name'                  => __( 'Локация', 'kzbpress' ),
        'all_items'                  => __( 'Всички Локации', 'kzbpress' ),
        'parent_item'                => __( 'Parent Item', 'kzbpress' ),
        'parent_item_colon'          => __( 'Parent Item:', 'kzbpress' ),
        'new_item_name'              => __( 'Нова Локация', 'kzbpress' ),
        'add_new_item'               => __( 'Добави Локация', 'kzbpress' ),
        'edit_item'                  => __( 'Редактирай Локация', 'kzbpress' ),
        'update_item'                => __( 'Обнови Локация', 'kzbpress' ),
        'view_item'                  => __( 'Виж Локация', 'kzbpress' ),
        'separate_items_with_commas' => __( 'Раздели със запетайки', 'kzbpress' ),
        'add_or_remove_items'        => __( 'Добави/Премахни', 'kzbpress' ),
        'choose_from_most_used'      => __( 'Избери най-използваните', 'kzbpress' ),
        'popular_items'              => __( 'Популярни', 'kzbpress' ),
        'search_items'               => __( 'Търси', 'kzbpress' ),
        'not_found'                  => __( 'Не е намерена', 'kzbpress' ),
        'no_terms'                   => __( 'Няма', 'kzbpress' ),
        'items_list'                 => __( 'Списък', 'kzbpress' ),
        'items_list_navigation'      => __( 'Навигация списък', 'kzbpress' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );
    register_taxonomy( 'point_locations', array( 'points' ), $args );

}
add_action('init', 'locations_tax', 0);

/* Convert new cities slugs to latin */
function convert_slug($term, $taxonomy)
{
    if ('point_locations' !== $taxonomy) {
        return $term;
    }

    $term['slug'] = transliterate($term['name']);

    return $term;
}
add_filter('wp_insert_term_data', 'convert_slug', 10, 2);