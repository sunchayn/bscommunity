<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

//if the host run an older php version - show an update error !
if (version_compare(PHP_VERSION, '5.5.0') < 0) {
    die ('please update your php version to 5.5.0 or higher, you current version is : '.PHP_VERSION);
}
// DIRECTORY_SEPARATOR adds a slash to the end of the path
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
// set a constant that holds the project's "application" folder, like "/var/www/application".
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);
//load functions
require_once ROOT . 'application/core/functions.php';
// load application config (error reporting etc.)
require_once ROOT . 'application/config/config.php';
// load application class
require_once ROOT . 'application/core/application.php';
require_once ROOT . 'application/core/controller.php';
require_once ROOT . 'application/core/view.php';
require_once ROOT . 'application/core/language.php';
// start the application
$app = new Application();