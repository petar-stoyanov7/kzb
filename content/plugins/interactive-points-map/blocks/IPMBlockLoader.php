<?php
/**
 * Custom Gutenberg Blocks loader
 *
 * @since      0.0.1
 *
 * @package    IPM
 * @subpackage IPM/blocks
 */

namespace IPM\Blocks;

use IPM\Helpers\IPMConfigHelper;

class IPMBlockLoader
{
    private IPMConfigHelper $ConfigHelper;
    private const BLOCKS = [
    ];
    private const DYNAMIC_BLOCKS = [
        'filter-map' => 'ipm_filter_map'
    ];

    public function __construct()
    {
        $this->ConfigHelper = new IPMConfigHelper();

        add_action('init', [$this,'load_blocks']);
        //lazy Gutenberg loading
        add_filter('should_load_separate_core_block_assets', '__return_true');
    }

    public function load_blocks()
    {
        $api_key = $this->ConfigHelper->get_api_key();

        foreach (self::BLOCKS as $block) {
            register_block_type(__DIR__ . "/build/{$block}");
        }

        foreach (self::DYNAMIC_BLOCKS as $block => $callback) {
            $path = __DIR__ . "/build/{$block}";
            if (file_exists("{$path}/index.php")) {
                require_once("{$path}/index.php");
            } elseif (file_exists("{$path}/init.php")) {
                require_once("{$path}/init.php");
            }

            register_block_type_from_metadata(
                "{$path}/block.json",
                [
                    'render_callback' => $callback
                ]
            );
        }
    }
}
