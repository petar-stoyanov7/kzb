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

use IPM\Helpers\ConfigHelper;

class IPMTaxonomy
{
    public function __construct()
    {
        $cfg = ConfigHelper::getTaxSettings();
        if (!$cfg) {
            return;
        }

        $this->config = $cfg;

        add_action('init', [$this,'init']);
        add_filter('wp_insert_term_data', [$this,'convert_slug'], 10, 2);
    }

    public function init()
    {
        if (empty($this->config)) {
            return;
        }
        $conf = $this->config;

        $labels = array(
            'name'                       => _x($conf['name'], 'Taxonomy General Name', 'ipm'),
            'singular_name'              => _x($conf['singular_name'], 'Taxonomy Singular Name', 'ipm'),
            'menu_name'                  => __($conf['menu_name'], 'ipm'),
            'all_items'                  => __($conf['all_items'], 'ipm'),
            'parent_item'                => __('Parent Item', 'ipm'),
            'parent_item_colon'          => __('Parent Item:', 'ipm'),
            'new_item_name'              => __($conf['new_item_name'], 'ipm'),
            'add_new_item'               => __($conf['add_new_item'], 'ipm'),
            'edit_item'                  => __($conf['edit_item'], 'ipm'),
            'update_item'                => __($conf['update_item'], 'ipm'),
            'view_item'                  => __($conf['view_item'], 'ipm'),
            'separate_items_with_commas' => __($conf['separate_items_with_commas'], 'ipm'),
            'add_or_remove_items'        => __($conf['separate_items_with_commas'], 'ipm'),
            'choose_from_most_used'      => __($conf['choose_from_most_used'], 'ipm'),
            'popular_items'              => __($conf['popular_items'], 'ipm'),
            'search_items'               => __($conf['search_items'], 'ipm'),
            'not_found'                  => __($conf['not_found'], 'ipm'),
            'no_terms'                   => __($conf['no_terms'], 'ipm'),
            'items_list'                 => __($conf['items_list'] , 'ipm'),
            'items_list_navigation'      => __($conf['items_list_navigation'], 'ipm'),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => $conf['public'],
            'show_ui'                    => $conf['show_ui'],
            'show_admin_column'          => $conf['show_admin_column'],
            'show_in_nav_menus'          => $conf['show_in_nav_menus'],
            'show_tagcloud'              => true,
            'show_in_rest'               => true,
        );
        register_taxonomy($conf['slug'], $conf['cpt'], $args);
    }

    private function _transliterate(string $word) : string
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

    public function convert_slug($term, $taxonomy)
    {
        if (empty($this->config)) {
            return $term;
        }

        if ($this->config['slug'] !== $taxonomy) {
            return $term;
        }

        $term['slug'] = transliterate($term['name']);

        return $term;
    }
}