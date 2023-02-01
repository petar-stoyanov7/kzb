<?php
/**
 * Plugin Name: Interactive Points Map (IPM)
 * Plugin URI: N\A
 * Description: This plugin creates an interactive map, based on CPT/taxonomy
 * Version: 0.0.1
 * Author: Petar Stoyanov
 * Author URI: https://pstoyanov.com
 * Text Domain: ipm
 */

namespace IPM;

use IPM\Admin\IPMAdminMenu;
use IPM\CPT\IPMPostType;
use IPM\CPT\IPMTaxonomy;
use IPM\Helpers\RestHelper;
use IPM\Helpers\ConfigHelper;

class IPM
{
    public string $version = '0.0.1';
    private array $settings = [];
    private string $name = 'Points Map';
    private string $slug = 'points-map';

    public function __construct()
    {

        require_once __DIR__ . '/helpers/ConfigHelper.php';
        require_once __DIR__ . '/helpers/RestHelper.php';
        require_once __DIR__ . '/cpt/IPMPostType.php';
        require_once __DIR__ . '/cpt/IPMTaxonomy.php';

        if (is_admin()) {
            require_once __DIR__ . '/admin/admin-menu.php';
        }
    }

    public function init()
    {
        $this->ipm_define('IPM', true);
        $this->ipm_define('IPM_PATH', plugin_dir_path(__FILE__));
        $this->ipm_define('IPM_URI', plugin_dir_url(__FILE__));
        $this->ipm_define('IPM_NAME', plugin_basename(__FILE__));
        $this->ipm_define('IPM_PLUGIN_NAME', $this->name);
        $this->ipm_define('IPM_PLUGIN_SLUG', $this->slug);
        $this->ipm_define('IPM_VERSION', $this->version);

        if (is_admin()) {
            $AdminMenu = new IPMAdminMenu();
        }


        $CPT = new IPMPostType();
        $Tax = new IPMTaxonomy();


//        $ConfigHelper = new ConfigHelper();
//        $RestHelper = new RestHelper();
    }

    public function register_cpt()
    {
    }

    private function ipm_define($name, $value) : void
    {
        if (!defined($name)) {
            define($name, $value);
        }
    }
}

$IPM = new IPM();
$IPM->init();