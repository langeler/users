<?php
// Show all errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// database hostname, you don't usually need to change this
define('db_host','localhost');

// database username
define('db_user','root');

// database password
define('db_pass','root');

// database name
define('db_name','test');

// database charset, change this only if utf8 is not supported by your language
define('db_charset','utf8');

// Email activation variables
// account activation required?
define('account_activation',false);

// Change "Your Company Name" and "yourdomain.com", do not remove the < and >
define('mail_from','Perunio');

// Add-ons config
define('csrf_protection',true);
define('brute_force_protection',true);

// MVC Config below
// Enable/disable cache, only enable the cache in production mode
define('cache_enabled',false);
define('cache_path', ROOT_DIR . '/cache/');
?>
