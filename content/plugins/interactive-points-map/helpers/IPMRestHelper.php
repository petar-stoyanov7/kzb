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


use WP_REST_Response;

class IPMRestHelper
{
    private IPMConfigHelper $ConfigHelper;
    private IPMTaxHelper $TaxHelper;

    public function __construct()
    {
        $this->ConfigHelper = new IPMConfigHelper();
        $this->TaxHelper = new IPMTaxHelper();

        //TODO get dynamic
        add_action('rest_api_init', [$this, 'register_rest_routes']);
    }

    public function register_rest_routes(): void
    {
        register_rest_route(
            'ipm/v1',
            '/maps/get-locations',
            [
                'methods' => 'POST',
                'callback' => [$this, 'get_locations'],
                'permission_callback' => '__return_true'
            ]
        );
        register_rest_route(
            'ipm/v1',
            '/maps/get-filtered-locations',
            [
                'methods' => 'POST',
                'callback' => [$this, 'get_filtered_locations'],
                'permission_callback' => '__return_true'
            ]
        );
    }

    public function get_locations($local = false)
    {
        $locations = $this->TaxHelper->get_taxonomy_list();

        if ($local) {
            return $locations;
        }

        return new WP_REST_Response($locations, 200);
    }

    public function get_filtered_locations() : WP_REST_Response
    {
        $locations = $this->get_locations(true);
        $locations = IPMHelper::filter_locations($locations);

        return new WP_REST_Response($locations, 200);
    }
}
