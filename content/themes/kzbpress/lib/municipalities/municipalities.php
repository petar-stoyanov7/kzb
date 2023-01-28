<?php
/**
 * This file is intended to dynamically add all Bulgarian municipalities and regions
 */

function create_slug(string $word) : string
{
    $word = mb_strtolower($word);
    $cyr = [
        ' ', 'ж',  'ч',  'щ',   'ш',  'ю',  'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ъ', 'ь', 'я',
    ];
    $lat = [
        '-', 'zh', 'ch', 'sht', 'sh', 'yu', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'a', 'j', 'ya',
    ];

    return str_replace($cyr, $lat, $word);
}

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
        $slug = create_slug($province);
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
            $slug = create_slug($municipality);
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