<?php
/**
 * This file is intended to dynamically add all Bulgarian municipalities and regions
 */

function populate_locations() : void
{
    $tax = get_terms('point_locations', ['hide_empty' => false]);
    if (!empty($tax) || count($tax) > 1) {
        return;
    }
    $locations = file_get_contents(__DIR__ . '/locations.json');
    if (!$locations) {
        return;
    }

    $locations = json_decode($locations, true);

    foreach ($locations as $province => $municipalities) {
        $slug = transliterate($province);
        $term_array = wp_insert_term(
            $province,
            'point_locations',
            [
                'slug' => $slug
            ]
        );

        if (!$term_array || is_wp_error($term_array) || !is_array($term_array) || count($term_array) < 2) {
            continue;
        }

        $parent_id = $term_array['term_id'];

        foreach ($municipalities as $municipality) {
            $slug = transliterate($municipality);
            wp_insert_term(
                $municipality,
                'point_locations',
                [
                    'slug'      => $slug,
                    'parent'    => $parent_id
                ]
            );
        }
    }
}

//add_action('init', 'populate_locations', 10);