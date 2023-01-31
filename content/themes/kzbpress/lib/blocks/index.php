<?php
$blocks = [];
foreach (scandir(__DIR__ . '/build') as $item) {
    if ('.' === $item || '..' === $item) {
        continue;
    }
    if (is_dir(__DIR__ . "/build/{$item}")) {
        $blocks[] = $item;
    }
}

foreach ($blocks as $block) {
    $path = __DIR__ . "/build/{$block}";
    if (file_exists("{$path}/init.php")) {
        require_once "{$path}/init.php";
    } elseif (file_exists("{$path}/index.php")) {
        require_once "{$path}/index.php";
    }
}

add_filter('should_load_separate_core_block_assets', '__return_true');
