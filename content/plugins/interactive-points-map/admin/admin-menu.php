<?php
/**
 * IPM Settings page
 *
 * @since      0.0.1
 *
 * @package    IPM
 * @subpackage IPM/admin
 */

namespace IPM\Admin;

class IPMAdminMenu
{
    public function __construct()
    {
        
        add_action('admin_menu', [$this, 'register_settings'], 4);
        add_action('admin_menu', [$this, 'init'], 5);
    }

    public function init()
    {
        
        
        add_menu_page(
            IPM_NAME,
            'Points Map Admin',
            'administrator',
            IPM_PLUGIN_SLUG,
            [$this,'admin_dashboard'],
            'dashicons-location-alt',
            99
        );

        add_submenu_page(
            IPM_PLUGIN_SLUG,
            'Plugin CPT Settings',
            'CPT Settings',
            'administrator',
            IPM_PLUGIN_SLUG . '-cpt-settings',
            [$this, 'display_cpt_settings']
        );
        add_submenu_page(
            IPM_PLUGIN_SLUG,
            'Plugin Tax Settings',
            'Taxonomy Settings',
            'administrator',
            IPM_PLUGIN_SLUG . '-tax-settings',
            [$this, 'display_tax_settings']
        );
    }
    
    public function admin_dashboard()
    {
        $active_tab = $_GET['tab'] ?? 'general';
        if (isset($_GET['error_message'])) {
            add_action('admin_notices', [$this, 'ipm_settings_messages']);
            do_action('admin_notices', $_GET['error_message']);
        }
        require_once __DIR__ . '/partials/main-page.php';
    }
    
    public function display_cpt_settings()
    {
        $active_tab = $_GET['tab'] ?? 'general';
        if (isset($_GET['error_message'])) {
            add_action('admin_notices', [$this, 'ipm_settings_messages']);
            do_action('admin_notices', $_GET['error_message']);
        }
        require_once __DIR__ . '/partials/cpt-page.php';
    }
    
    public function display_tax_settings()
    {
        $active_tab = $_GET['tab'] ?? 'general';
        if (isset($_GET['error_message'])) {
            add_action('admin_notices', [$this, 'ipm_settings_messages']);
            do_action('admin_notices', $_GET['error_message']);
        }
        require_once __DIR__ . '/partials/tax-page.php';
    }
    
    public function register_settings()
    {
        $sections = [
            [
                'slug' => 'ipm_general_settings',
                'name' => 'General Settings',
                'inputs' => [
                    'ipm_general_gmaps_api' => 'Google Maps API Key'
                ],
                'booleans' => [],
            ],
            [
                'slug' => 'ipm_cpt_settings',
                'name' => 'Custom Post Type (CPT) Settings',
                'inputs' => [
                    'ipm_cpt_name' => 'CPT Name',
                    'ipm_cpt_slug' => 'CPT Slug',
                    'ipm_cpt_singular' => 'Singular name',
                    'ipm_cpt_menu_name' => 'Menu name',
                    'ipm_cpt_all_items' => 'All Items Name',
                    'ipm_cpt_items_list' => 'Items List',
                    'ipm_cpt_items_list_filter' => 'Items List Filter',
                    'ipm_cpt_items_list_nav' => 'Items List Navigation',
                    'ipm_cpt_new_item' => 'New Item',
                    'ipm_cpt_update_item' => 'Update Item',
                    'ipm_cpt_edit_item' => 'Edit Item',
                    'ipm_cpt_view_item' => 'View Item',
                    'ipm_cpt_view_items' => 'View Items',
                    'ipm_cpt_search_items' => 'Search Item',
                    'ipm_cpt_not_found' => 'Not Found',
                    'ipm_cpt_add_new_item' => 'Add New Item',
                    'ipm_cpt_insert_into_item' => 'Insert Into Item',
                    'ipm_cpt_uploaded_to_item' => 'Uploaded Into Item',
                    'ipm_cpt_featured_image' => 'Featured Image',
                    'ipm_cpt_set_featured_image' => 'Set Feratured Image',
                    'ipm_cpt_use_featured_image' => 'Use Featured Image',
                    'ipm_cpt_remove_featured_image' => 'Remove Featured Image',
                    'ipm_cpt_plural' => 'Name Plural',
                    'ipm_cpt_menu_position' => 'Menu Position',
                    'ipm_cpt_taxonomy' => 'Taxonomy Slug'
                ],
                'booleans' => [
                    'ipm_cpt_show_ui'=> 'Show in UI',
                    'ipm_cpt_show_menu' => 'Show Admin Menu',
                    'ipm_cpt_show_admin_bar' => 'Show in Admin Bar',
                ]
            ],
            [
                'slug' => 'ipm_tax_settings',
                'name' => 'Custom Taxonomy Settings',
                'inputs' => [
                    'ipm_tax_name' => 'Taxonomy Name',
                    'ipm_tax_slug' => 'Taxonomy Slug',
                    'ipm_tax_singular_name' => 'Singular Name',
                    'ipm_tax_menu_name' => 'Menu Name',
                    'ipm_tax_all_items' => 'All Items',
                    'ipm_tax_new_item_name' => 'New Item Name',
                    'ipm_tax_add_new_item' => 'Add New Item',
                    'ipm_tax_edit_item' => 'Edit Item',
                    'ipm_tax_update_item' => 'Update Item',
                    'ipm_tax_view_item' => 'View Item',
                    'ipm_tax_separate_items_with_commas' => 'Separate With Commas',
                    'ipm_tax_add_or_remove_items' => 'Add or Remove Items',
                    'ipm_tax_choose_from_most_used' => 'Choose from Most Used',
                    'ipm_tax_popular_items' => 'Tax Popular Items',
                    'ipm_tax_search_items' => 'Search Items',
                    'ipm_tax_not_found' => 'Not Found',
                    'ipm_tax_no_terms' => 'No Terms',
                    'ipm_tax_items_list' => 'Items List',
                    'ipm_tax_items_list_navigation' => 'List Navigation',
                ],
                'booleans' => [
                    'ipm_tax_public' => 'Is Public',
                    'ipm_tax_show_ui' => 'Show in UI',
                    'ipm_tax_show_admin_column' => 'Show in Admin Column',
                    'ipm_tax_show_in_nav_menus' => 'Show in Nav Menus',
                ]
            ]
        ];

        foreach ($sections as $section) {
            $this->_register_setting($section);
        }
    }


    public function ipm_settings_messages($msg)
    {
        switch ($msg) {
            case '1':
                $message = __(
                    'There was an error adding this setting. Please try again.  
                    If this persists, shoot us an email.', 'my-text-domain'
                );
                $err_code = esc_attr('ipm_name_example_setting');
                $setting_field = 'ipm_name_example_setting';
                break;
        }
        $type = 'error';
        add_settings_error(
            $setting_field,
            $err_code,
            $message,
            $type
        );
    }

    public function ipm_render_field($args)
    {
        if ($args['wp_data'] == 'option') {
            $wp_data_value = get_option($args['name']);
        } elseif ($args['wp_data'] == 'post_meta') {
            $wp_data_value = get_post_meta($args['post_id'], $args['name'], true);
        }

        switch ($args['type']) {
            case 'input':
                $value = ($args['value_type'] == 'serialized') ? serialize($wp_data_value) : $wp_data_value;
                if ($args['subtype'] != 'checkbox') {
                    $prependStart = (isset($args['prepend_value']))
                        ? '<div class="input-prepend"> <span class="add-on">' . $args['prepend_value'] . '</span>'
                        : '';
                    $prependEnd = (isset($args['prepend_value'])) ? '</div>' : '';
                    $step = (isset($args['step'])) ? 'step="' . $args['step'] . '"' : '';
                    $min = (isset($args['min'])) ? 'min="' . $args['min'] . '"' : '';
                    $max = (isset($args['max'])) ? 'max="' . $args['max'] . '"' : '';
                    if (isset($args['disabled'])) {
                        $val = esc_attr($value);
                        echo <<<html
{$prependStart}
    <input 
        type="{$args['subtype']}" 
        id="{$args['id']}_disabled"
        {$step} {$max} {$min} 
        name="{$args['name']}_disabled" 
        size="40" 
        disabled 
        value="{$val}" 
    />
    <input 
        type="hidden" 
        id="{$args['id']}" 
        {$step} {$max} {$min} 
        name="{$args['name']}" 
        size="40" 
        value="{$val}" 
    /> 
{$prependEnd}
html;
                    } else {
                        $val = esc_attr($value);
                        echo <<<html
$prependStart 
 <input 
    type="{$args['subtype']}" 
    id="{$args['id']}" 
    "{$args['required']}" 
    {$step} {$max} {$min} 
    name="{$args['name']}"
    placeholder="{$args['placeholder']}" 
    size="40" 
    value="{$val}" 
/>
{$prependEnd}
html;
                    }

                } else {
                    $checked = ($value) ? 'checked' : '';
                    echo <<<html
<input 
    type="{$args['subtype']}" 
    id="{$args['id']}" 
    "{$args['required']}" 
    name="{$args['name']}" 
    size="40" 
    value="1" 
    {$checked}
/>
html;
                }
                break;
            case 'multiselect':
                $isMultiple = true;
            case 'select':
                $value = ($args['value_type'] == 'serialized') ? serialize($wp_data_value) : $wp_data_value;
                $prependStart = (isset($args['prepend_value']))
                    ? '<div class="input-prepend"> <span class="add-on">' . $args['prepend_value'] . '</span>'
                    : '';
                $prependEnd = (isset($args['prepend_value'])) ? '</div>' : '';

                $select = <<<html
<select id="{$args['id']}" name="{$args['name']}">
html;
                if (!empty($isMultiple) && $isMultiple) {
                    $select = <<<html
<select id="{$args['id']}" name="{$args['name']}[]" multiple="multiple">
html;
                }
                $string = <<<html
{$prependStart}
{$select}
html;

                foreach ($args['get_options_list'] as $val => $name) {
                    $selected = $val === $value ? 'selected' : '';
                    if (is_array($value)) {
                        $select = in_array($val, $value) ? 'selected' : '';
                    }
                    $string .= <<<html
<option {$selected} value="{$val}">{$name}</option>
html;
                }
                $string .= <<<html
</select>
{$prependEnd}
html;
                echo $string;
                break;
            case 'checkboxes':
                $values = ($args['value_type'] == 'serialized') ? serialize($wp_data_value) : $wp_data_value;
                $prependStart = (isset($args['prepend_value']))
                    ? '<div class="input-prepend"> <span class="add-on">' . $args['prepend_value'] . '</span>'
                    : '';
                $prependEnd = (isset($args['prepend_value'])) ? '</div>' : '';
                $string = <<<html
{$prependStart}
html;
                foreach ($args['get_options_list'] as $val => $name) {
                    $checked = in_array($val, $values) ? 'checked' : '';
                    $string .= <<<html
<div>
    <input type="checkbox" name="{$args['name']}[]" value="{$val}" {$checked}/>
    <label for="{$args['id']}">{$name}</label>
</div>
html;

                }
                $string .= <<<html
{$prependStart}
html;
                echo $string;
                break;
            default:
                # code...
                break;
        }
    }

    private function _register_setting($section) : void
    {
        $section_name = $section['name'];
        $section_slug = $section['slug'];
        $input_fields = $section['inputs'];
        $bool_fields = $section['booleans'];

        add_settings_section(
            $section_slug,
            $section_name,
            NULL,
            $section_slug
        );

        foreach ($input_fields as $slug => $title) {
            add_settings_field(
                $slug,
                $title,
                [$this, 'ipm_render_field'],
                $section_slug,
                $section_slug,
                [
                    'type' => 'input',
                    'subtype' => 'text',
                    'id' => $slug,
                    'name' => $slug,
                    'placeholder' => '',
                    'required' => 'true',
                    'get_options_list' => '',
                    'value_type' => 'normal',
                    'wp_data' => 'option'
                ]
            );
            register_setting(
                $section_slug,
                $slug
            );
        }
        foreach ($bool_fields as $slug => $title) {
            add_settings_field(
                $slug,
                $title,
                [$this, 'ipm_render_field'],
                $section_slug,
                $section_slug,
                [
                    'type' => 'select',
                    'subtype' => 'text',
                    'id' => $slug,
                    'name' => $slug,
                    'required' => 'true',
                    'placeholder' => '',
                    'get_options_list' => [
                        'no' => 'No',
                        'yes' => 'Yes',
                    ],
                    'value_type' => 'normal',
                    'wp_data' => 'option'
                ]
            );
            register_setting(
                $section_slug,
                $slug
            );
        }
    }
}