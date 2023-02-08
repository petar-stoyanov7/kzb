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

use IPM\Helpers\IPMConfigHelper;
use IPM\Helpers\IPMHelper;

class IPMTaxHelper
{
    private string $tax_slug = '';

    public function __construct()
    {
        $this->tax_slug = self::get_tax_slug();
    }

    public function get_taxonomy_list($hide_empty = false) : array
    {
        $tax_list = [];
		$terms = get_terms([
			'taxonomy' => $this->tax_slug,
			'hide_empty' => $hide_empty
		]);
        if ((bool)$terms && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $tax_list[] = [
                    'id' => $term->term_id,
                    'name' => $term->name,
                    'slug' => $term->slug,
                    'parent' => $term->parent
                ];
            }
        }

        return $tax_list;
    }

    public function get_taxonomy_name() : string
    {
        return $this->tax_slug;
    }

    protected static function get_tax_slug() : string
    {

        return IPMConfigHelper::get_tax_slug();
    }


    public static function parse_json_file(string $raw_json) : void
    {
        IPMHelper::wp_load();

        if (empty($raw_json)) {
            return;
        }

        $locations = json_decode($raw_json, true);
        $taxonomy = self::get_tax_slug();

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