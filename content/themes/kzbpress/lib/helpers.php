<?php
/**
 * Helper functions
 */

function transliterate(string $word) : string
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
