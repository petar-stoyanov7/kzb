<?php
/**
 * Rest endpoints helper
 *
 * @since      0.0.1
 *
 * @package    IPM
 * @subpackage IPM/Helpers/
 */

namespace IPM\Helpers;


class RestHelper
{
    private ConfigHelper $ConfigHelper;

    public function __construct()
    {
        //TODO get dynamic
        add_action('rest_api_init', [$this, 'register_rest_routes']);
    }

    public function register_rest_routes(): void
    {
        register_rest_route(
            'kzb/v1',
            '/maps/get-locations',
            [
                'methods' => 'POST',
                'callback' => [$this, 'get_locations'],
                'permission_callback' => '__return_true'
            ]
        );
    }

    public function get_locations(): void
    {
        $locations = [];
        $provinces = get_terms([
            'parent' => 0,
            'taxonomy' => 'point_locations',
            'hide_empty' => false
        ]);

        foreach ($provinces as $province) {
            $term_id = $province->term_id;
            $locations[] = [
                'id' => $term_id,
                'name' => $province->name,
                'slug' => $province->slug,
                'children' => $this->_get_children($term_id),
            ];
        }

        echo json_encode($locations);
    }

    private function _get_children($term_id): array
    {
        $list = [];
        $terms = get_terms([
            'parent' => $term_id,
            'taxonomy' => 'point_locations',
            'hide_empty' => false
        ]);
        if (empty($terms) || count($terms) < 1) {
            return $list;
        }

        foreach ($terms as $term) {
            $list[] = [
                'id' => $term->term_id,
                'name' => $term->name,
                'slug' => $term->slug,
                'children' => $this->_get_children($term->term_id),
            ];
        }

        return $list;
    }
}
