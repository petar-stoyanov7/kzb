<?php
/**
 * Configurations helper
 *
 * @since      0.0.1
 *
 * @package    IPM
 * @subpackage IPM/helpers
 */

namespace IPM\Helpers;

class IPMConfigHelper
{
    public function __construct()
    {
        //
    }

    /**
     * Get option parameter
     * @param $string
     * @return string|int|mixed|void
     */
    protected static function get_config($configName, $default = '')
    {
        $setting = get_option($configName);
        return (bool)$setting ? $setting : $default;
    }


    /**
     * Get boolean option parameter
     * @param $configName
     * @return bool
     */
    protected static function get_bool_config($configName, $default = false) : bool
    {
        $setting = get_option($configName);
        if ($setting) {
            return 'yes' === strtolower($setting) || 1 === (int)$setting;
        }
        return $default;
    }


    /**
     * Gets the configured google maps API key
     * @return string
     */
    public function get_api_key() : string
    {
        return self::get_config('ipm_general_gmaps_api');
    }

    /**
     * Return the settings for the Custom Post Type
     * @return array|bool
     */
    public static function getCptSettings()
    {
        $cptName = self::get_config('ipm_cpt_name');
        $slug = self::get_config('ipm_cpt_slug');

        if (empty($cptName) || empty($slug)) {
            return false;
        }

        return [
            'name'                      => $cptName,
            'slug'                      => $slug,
            'singular'                  => self::get_config('ipm_cpt_singular'),
            'menu_name'                 => self::get_config('ipm_cpt_menu_name'),
            'all_items'                 => self::get_config('ipm_cpt_all_items'),
            'items_list'                => self::get_config('ipm_cpt_items_list'),
            'items_list_filter'         => self::get_config('ipm_cpt_items_list_filter'),
            'items_list_nav'            => self::get_config('ipm_cpt_items_list_nav'),
            'new_item'                  => self::get_config('ipm_cpt_new_item'),
            'update_item'               => self::get_config('ipm_cpt_update_item'),
            'edit_item'                 => self::get_config('ipm_cpt_edit_item'),
            'view_item'                 => self::get_config('ipm_cpt_view_item'),
            'view_items'                => self::get_config('ipm_cpt_view_items'),
            'search_items'              => self::get_config('ipm_cpt_search_items'),
            'add_new_item'              => self::get_config('ipm_cpt_add_new_item'),
            'not_found'                 => self::get_config('ipm_cpt_not_found'),
            'insert_into_item'          => self::get_config('ipm_cpt_insert_into_item'),
            'uploaded_to_item'          => self::get_config('ipm_cpt_uploaded_to_item'),
            'featured_image'            => self::get_config('ipm_cpt_featured_image'),
            'set_featured_image'        => self::get_config('ipm_cpt_set_featured_image'),
            'use_featured_image'        => self::get_config('ipm_cpt_use_featured_image'),
            'remove_featured_image'     => self::get_config('ipm_cpt_remove_featured_image'),
            'plural'                    => self::get_config('ipm_cpt_plural'),
            'menu_position'             => self::get_config('ipm_cpt_menu_position', 5),
            'taxonomy'                  => self::get_config('ipm_cpt_taxonomy'),
            'show_ui'                   => self::get_bool_config('ipm_cpt_show_ui'),
            'show_menu'                 => self::get_bool_config('ipm_cpt_show_menu'),
            'show_admin_bar'            => self::get_bool_config('ipm_cpt_show_admin_bar'),
        ];
    }

    /**
     * Returns the settings for taxonomy
     * @return array|false
     */
    public static function getTaxSettings()
    {
        $name = self::get_config('ipm_tax_name', false);
        $slug = self::get_config('ipm_tax_slug', false);

        if (empty($name) || empty($slug)) {
            return false;
        }

        return [
            'name' => $name,
            'slug' => $slug,
            'cpt'                           => self::get_config('ipm_cpt_slug'),
            'singular_name'                 => self::get_config('ipm_tax_singular_name'),
            'menu_name'                     => self::get_config('ipm_tax_menu_name'),
            'all_items'                     => self::get_config('ipm_tax_all_items'),
            'new_item_name'                 => self::get_config('ipm_tax_new_item_name'),
            'add_new_item'                  => self::get_config('ipm_tax_add_new_item'),
            'edit_item'                     => self::get_config('ipm_tax_edit_item'),
            'update_item'                   => self::get_config('ipm_tax_update_item'),
            'view_item'                     => self::get_config('ipm_tax_view_item'),
            'separate_items_with_commas'    => self::get_config('ipm_tax_separate_items_with_commas'),
            'add_or_remove_items'           => self::get_config('ipm_tax_add_or_remove_items'),
            'choose_from_most_used'         => self::get_config('ipm_tax_choose_from_most_used'),
            'popular_items'                 => self::get_config('ipm_tax_popular_items'),
            'search_items'                  => self::get_config('ipm_tax_search_items'),
            'not_found'                     => self::get_config('ipm_tax_not_found'),
            'no_terms'                      => self::get_config('ipm_tax_no_terms'),
            'items_list'                    => self::get_config('ipm_tax_items_list'),
            'items_list_navigation'         => self::get_config('ipm_tax_items_list_navigation'),
            'public'                        => self::get_bool_config('ipm_tax_public'),
            'show_ui'                       => self::get_bool_config('ipm_tax_show_ui'),
            'show_admin_column'             => self::get_bool_config('ipm_tax_show_admin_column'),
            'show_in_nav_menus'             => self::get_bool_config('ipm_tax_show_in_nav_menus'),
        ];
    }

    /**
     * Returns the Custom Post Type slug
     * @return int|mixed|string|void
     */
    public static function get_cpt_slug()
    {
        return self::get_config('ipm_cpt_slug');
    }

    /**
     * Returns the Taxonomy slug
     * @return int|mixed|string|void
     */
    public static function get_tax_slug()
    {
        return self::get_config('ipm_tax_slug');
    }
}