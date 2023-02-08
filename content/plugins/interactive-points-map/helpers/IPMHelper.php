<?php
/**
 * General helper
 *
 * @since      0.0.1
 *
 * @package    IPM
 * @subpackage IPM/helpers
 */

namespace IPM\Helpers;

class IPMHelper
{
    /**
     * Convert from cyrillic to latin
     * @param string $word
     * @return string
     */
    public static function transliterate(string $word) : string
    {
        $cyr  = array('а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у',
            'ф','х','ц','ч','ш','щ','ъ', 'ы','ь', 'э', 'ю','я','А','Б','В','Г','Д','Е','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У',
            'Ф','Х','Ц','Ч','Ш','Щ','Ъ', 'Ы','Ь', 'Э', 'Ю','Я' );
        $lat = array( 'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p','r','s','t','u',
            'f' ,'h' ,'ts' ,'ch','sh' ,'sht' ,'a', 'i', 'y', 'e' ,'yu' ,'ya','A','B','V','G','D','E','Zh',
            'Z','I','Y','K','L','M','N','O','P','R','S','T','U',
            'F' ,'H' ,'Ts' ,'Ch','Sh' ,'Sht' ,'A' ,'Y' ,'Yu' ,'Ya' );

        return str_replace($cyr, $lat, $word);
    }


    /**
     * Create a slug from name
     * @param string $word
     * @return string
     */
    public static function slugify(string $word) : string
    {
        $word = mb_strtolower($word);
        $word = preg_replace("/\s/", '-', $word);
        return self::transliterate($word);
    }

    /**
     * Load WP Functions
     * @return void
     */
    public static function wp_load() : void
    {
        $wp_load_file = dirname(__DIR__, 4) . '/app/wp-load.php';
        $loaded_files = get_included_files();
        if (!in_array($wp_load_file, $loaded_files)) {
            require_once $wp_load_file;
        }
    }

    public static function filter_locations($locations, $parent_array = [], $result = []) : array
    {
        if (0 === count($parent_array) && 0 === count($result)) {
            /* First Iteration */
            $filtered_locations = [];
            $temp_array = [];
            foreach ($locations as $i => $location) {
                if (0 === $location['parent'] || empty($location['parent'])) {
                    $temp_array[] = $location;
                    unset($locations[$i]);
                }
            }
            $filtered_locations[] = $temp_array;
            return self::filter_locations($locations, $temp_array, $filtered_locations);
        } elseif (0 === count($locations)) {
            /* Last Iteration */
            return $result;
        } else {
            /* Recursive Iteration */
            $temp_array = [];
            $parents = array_column($parent_array, 'id');
            foreach ($locations as $i => $location) {
                if (in_array($location['parent'], $parents)) {
                    $temp_array[] = $location;
                    unset($locations[$i]);
                }
            }
            $result[] = $temp_array;
            return self::filter_locations($locations, $temp_array, $result);
        }
    }
}