<?php

use Core\App;
use Core\DB;

/*
 * Registering the config file content in the app dispatcher.
 */
App::bind('config', require __DIR__ . '/../config.php');

$config = App::get('config');

/*
 * Registering the database configuration in the app dispatcher.
 */
App::bind('db', new DB($config['database']) );

/*
 * Registering the storage path and debug mode to the app dispatcher.
 */
foreach (['debug', 'storage_path'] as $key) {
    if (isset($config[$key])) App::bind($key, $config[$key]);
}

/*
 * Registering the log file.
 */
if (isset($config['log_file_path'])) {
    App::bind('log_file_path', $config['log_file_path']);
}

/*
 * Setting the base url of the app.
 */
if (isset($config['base_url'])) {
    App::bind('base_url', $config['base_url']);
}
else App::bind('base_url', get_current_base_uri());

/*
 * Registering the silly auth details for the authentication.
 */
if (isset($config['silly_auth'])) {
    App::bind('auth', new \Core\SillyAuth(
        $config['silly_auth']['user'],
        $config['silly_auth']['pass'],
        $config['silly_auth']['cookie_name'],
        $config['silly_auth']['session_name']
    ));
}

/*
 * Registering the ecryption keys for the encrypter class.
 */
if (isset($config['encrypter'])) {
    App::bind('encrypter', new \Core\Encrypter(
        $config['encrypter']['key'],
        $config['encrypter']['iv']
    ));
}

/*
 * Displaying all the errors in case of debud mode = true.
 * NOTE: there is the same error handling configuration also in the index.php,
 * file having the error handling in the index.php file is more effective
 * because it can show errors triggered by the core. Instead if you delete the
 * error handling in the index.php leaving only the following it will show only
 * the errors triggered by the app.
 */
if (App::get('debug')) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    set_error_handler('error_notice_warning_handle');

    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}
