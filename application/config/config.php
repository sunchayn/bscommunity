<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
*/

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
define('ENVIRONMENT', 'production');
if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}else{
    error_reporting(0);
    ini_set("display_errors", 0);
}

/**
 * Configuration for: URL
 * Here we auto-detect your applications URL and the potential sub-folder. Works perfectly on most servers and in local
 * development environments (like WAMP, MAMP, etc.). Don't touch this unless you know what you do.
 *
 * URL_PUBLIC_FOLDER:
 * The folder that is visible to public, users will only have access to that folder so nobody can have a look into
 * "/application" or other folder inside your application or call any other .php file than home.php inside "/public".
 *
 * URL_PROTOCOL:
 * The protocol. Don't change unless you know exactly what you do.
 *
 * URL_DOMAIN:
 * The domain. Don't change unless you know exactly what you do.
 *
 * URL_SUB_FOLDER:
 * The sub-folder. Leave it like it is, even if you don't use a sub-folder (then this will be just "/").
 *
 * URL:
 * The final, auto-detected URL (build via the segments above). If you don't want to use auto-detection,
 * then replace this line with full URL (and sub-folder) and a trailing slash.
 */
define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', 'http://');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 */
if (file_exists(APP.'config/core.php'))
    require_once APP.'config/core.php';
define('DB_TYPE', 'mysql');
define('DB_CHARSET', 'utf8');

/**
 * Auto load classes
 */
spl_autoload_register(function($class){
    preg_match('/(API)$/', $class, $matches);
    if (!empty($matches))
        require_once ROOT .'application/models/' . $class . '.php';
    else
    {
        if (is_readable(ROOT .'application/helper/' . $class . '.php')) {
            require ROOT .'application/helper/' . $class . '.php';
        }elseif(is_readable(ROOT .'application/helper/vendor/' . strtolower($class) . '.php'))
            require ROOT .'application/helper/vendor/' . strtolower($class) . '.php';
        else
            die('check directories paths for classes call !');
    }
});
/**
 * Configuration for: sessions
 * initialise a sessions & define the sessions names
 */
//sessions names prefix
define('SESSION_PREFIX', 'bss_');
Session::initSession();
//logged user sessions name
define('LOGIN_SESSION_NAME', 'BSCUID');
//remember me cookies name
define('REM_COOKIE_NAME', 'BSCRCH');
//token session name
define('TOKEN_NAME', 'TOKEN');
//ajax attempts name
define('AJAX', 'AJAX_ATTEMPTS');

/**
 * Configuration for: language
 * Set the default language
 */
if (isset($_GET['lang']))
    Session::set('BSCLANG', $_GET['lang']);
//set the language code
define('LANGUAGE_CODE', isset_get($_SESSION, 'bss_BSCLANG', 'ar'));
//set the direction value for icon direction purpose
define('DIRECTION', (LANGUAGE_CODE == 'ar') ? 'left' : 'right');
//set the paragraphe direction
define('DIRECTION_CODE', (LANGUAGE_CODE == 'ar') ? 'rtl' : 'ltr');