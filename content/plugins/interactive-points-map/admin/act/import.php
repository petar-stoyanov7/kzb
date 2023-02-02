<?php

use IPM\Helpers\IPMTaxHelper;

//Wordpress functions

require_once dirname(__DIR__, 2) . '/helpers/IPMTaxHelper.php';
require_once dirname(__DIR__, 2) . '/helpers/IPMHelper.php';
require_once dirname(__DIR__, 2) . '/helpers/ConfigHelper.php';


if (empty($_FILES) || empty($_FILES['locations'])) {
    return;
}
$locations = file_get_contents($_FILES['locations']['tmp_name']);
if (!empty($locations)) {
    IPMTaxHelper::parse_json_file($locations);
}
