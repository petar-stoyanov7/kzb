<?php

$table_prefix = 'kzb_';
if (file_exists(dirname(__FILE__) . '/wp-config-local.php')) {
    require_once dirname(__FILE__) . '/wp-config-local.php';
} else {
    define('APP_ROOT', dirname(__DIR__));
    define('APP_ENV', getenv('APPLICATION_ENV'));

    define('DB_NAME', 'name_goes_here');
    define('DB_USER', 'name_goes_here');
    define('DB_PASSWORD', 'super_secret_pass');
    define('DB_HOST', 'page_hostname');
    define('DB_CHARSET', 'utf8');
    define('DB_COLLATE', '');
    define('WP_DEBUG', true);

    define('WP_HOME', 'http://site.url');
    define('WP_SITEURL', 'http://site.url/app');
    define('WP_CONTENT_URL', 'http://site.url/content');
    define('WP_CONTENT_DIR', dirname(__FILE__) . '/content');
}

define('AUTH_KEY', ';8ot2b$Y$(;_+4^![3ka!*rASD987asda8s7D^!@#AS*D&^<%J{upP1y;Sc7-{^eA5!!-~j!W%3#l~F');
define('SECURE_AUTH_KEY', 'ZN`?>g!`#%IPmR.pwW(SDFG&(ASD*F&(*as9d87a9sDA(AS*d7ASD*(7)-0*jDMvt%{3pQ e+8`;-M^;');
define('LOGGED_IN_KEY', '7pF8#$ASD()_AS)_(D*A(SD*&^Cjkhgsda[!|aLL+p;y1Augww^Lrvy&v>FEp!Hs>Rv6[jn85ER0e}*a');
define('NONCE_KEY', '#I5(m#`;z,Tfw0:abe;-sk@m509asdf0n)(B))B9N0(*M&)(*7HJG$9Dxrr;@/4,A-gDhw52J');
define('AUTH_SALT', 'GmIH;4%c`CuQ0+p254ZNH(j`*tSUo &L:KIOLZ*HLASI[z!!buocHKDJaC4dw0$OGIg%etCD');
define('SECURE_AUTH_SALT', 'jAZ>|+|Sci-S>3+3M)+!k=nFp@j6!@##asxlpkd#33AO2oH%X2g>;!3`J:-WZ3jN{');
define('LOGGED_IN_SALT', 'U|Bl.|]5+R1&|F^aAS-09ASD8SA(*7ASD][]RyejhVr|0,1o||3KVi7o1%CZfObs4rU%I$*l?9');
define('NONCE_SALT', '&2Iz7BL1<*yVa0MZvh*(A&SD)_(ISJKAL;DASD9ASD.ZXKkljashdPx=:9O&]f7K|/+X-Tu^M%(-kqnWl7<7');


/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . '/wp-settings.php');