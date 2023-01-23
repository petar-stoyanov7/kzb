<?php
$config = THEME_JSON;
$template_dir = get_template_directory();
$path = $config["settings"]["gutenberg"]["blocks"]["path"];

add_action('wp_enqueue_scripts', 'custom_blocks_autoloader');
add_action('enqueue_block_editor_assets', 'custom_blocks_autoloader');
function custom_blocks_autoloader()
{
    global $config;
    $template_dir = get_template_directory();
    $path = $config["settings"]["gutenberg"]["blocks"]["path"];


    foreach ($config["settings"]["gutenberg"]["blocks"]["autoload"] as $key => $block) {
        register_block_type("$template_dir/$path/$block");
    }
}


add_action('init', 'gutenberg_autoload_dynamic_blocks');
function gutenberg_autoload_dynamic_blocks()
{
    global $config;
    $dynamic_blocks = !empty($config["settings"]["gutenberg"]["blocks"]["dynamic_blocks"])
        ? $config["settings"]["gutenberg"]["blocks"]["dynamic_blocks"]
        : [];

    if (empty($dynamic_blocks)) {
        return;
    }

    foreach ($dynamic_blocks as $block_path => $block) {
        if (file_exists(__DIR__ . "/$block_path/init.php") && $block["include_php"]) {
            // require init.php if exists
            require_once __DIR__ . "/$block_path/init.php";
        }

        $callback = (!empty($block['callback']))
            ? ['render_callback' => $block['callback']]
            : [];
        register_block_type_from_metadata(__DIR__ . "/$block_path/block.json", $callback);
    }
}

// enable lazy gutenerg loading
add_filter('should_load_separate_core_block_assets', '__return_true');
