<?php
/**
 * Taxonomy helper
 *
 * @since      0.0.1
 *
 * @package    IPM
 * @subpackage IPM/helpers
 */


namespace IPM\Helpers;

use IPM\Helpers\ConfigHelper;
use IPM\Helpers\IPMHelper;

class IPMTaxHelper
{
    public static function parse_json_file(string $raw_json) : void
    {
        IPMHelper::wp_load();

        if (empty($raw_json)) {
            return;
        }

        $locations = json_decode($raw_json, true);
        $taxonomy = ConfigHelper::get_tax_slug();

        self::parse_array($locations, $taxonomy);
    }

    protected static function parse_array($arr, $taxonomy, $parent_id = 0) : void
    {
        if (empty($arr) || !is_array($arr) || count($arr) < 1) {
            return;
        }

        foreach ($arr as $key => $value) {
            $term = $key;

            if (!is_string($key)) {
                $term = $value;
            }

            $slug = IPMHelper::slugify($term);
            $term_array = wp_insert_term(
                $term,
                $taxonomy,
                [
                    'slug' => $slug,
                    'parent' => $parent_id
                ]
            );

            if (!$term_array || is_wp_error($term_array) || !is_array($term_array) || count($term_array) < 2) {
                continue;
            }
            $new_parent = $term_array['term_id'];
            if (is_array($value)) {
                self::parse_array($value, $taxonomy, $new_parent);
            }
        }
    }
}