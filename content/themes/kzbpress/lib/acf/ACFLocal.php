<?php
/**
 * This class provides ACF with custom file system storage place for the custom fields
 */
class ACFLocal
{
    public function __construct()
    {
        if (!class_exists('ACF')) {
            return;
        }

        add_filter('acf/settings/save_json', [$this,'acf_local_save']);
        add_filter('acf/settings/load_json', [$this,'acf_local_load']);
    }

    /**
     * Adds custom directory for fields json settings
     * @return string
     */
    public function acf_local_save() : string
    {
        $path = __DIR__ . '/json';

        return $path;
    }

    /**
     * Loads json files from custom directory
     * @return array
     */
    public function acf_local_load() : array
    {
        $path[] = __DIR__ . '/json';

        return $path;
    }
}

$ACFLocal = new ACFLocal();