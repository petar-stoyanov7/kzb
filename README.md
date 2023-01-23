# Caps for Future

## Disclaimer
This project is created for the Caps for Future (Капачки за Бъдеще) and all its related activities

## Project Installation
In order to install this project locally you need the following
* node
* wp cli
* knowledge on how to work with at least npm

1. WordPress setup and installation

For local installation - you will need a dump of the DB. Contact project owners for one. Create a 
"wp-config-local.php" - this will be your local repository. The file must contain the following
```
define('DB_NAME', '{local db name}');
define('DB_USER', '{your db user}');
define('DB_PASSWORD', '{your db pass}');
define('DB_HOST', '{the host DB is hosted at}');

define('WP_HOME', '{your-site-here}');
define('WP_SITEURL', '{your-site-here}/app');
define('WP_CONTENT_URL', '{your-site-here}/content');
define('WP_CONTENT_DIR', dirname(__FILE__) . '/content');
```
Not creating it - it will use the default wp-config file, which at the moment of writing is not functional.

Next install [wp cli](https://www.npmjs.com/package/wp-cli). In the root of the project execute the 
following command
```shell
wp core download
```
If you would use WordPress's web interface (or as WP folks wrongly call it - "backend") - you will need a user
```shell
wp user create {user} {email} --role=administrator 
```

2. Theme setup and installation

Navigate to **content/themes/kzbpress/src/** 

if you used different from the default site URL in wp-config-local.php - in config.json change the "proxy" to whatever 
URL you use. Keep in mind that for the local dev to work - the URL that is configured for local development must 
point towards localhost (127.0.0.1). If you are not using *AMP - easiest way to do this is by editing your hosts file

After this - run
```shell
npm install
```
After node_modules are installed - you can run the project for local development with
```shell
npm start
```
Or if you want to build it to be production ready:
```shell
npm run build
```
