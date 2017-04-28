<?php
ini_set('error_reporting', E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
//ini_set('display_errors', 1);
define('REQUEST_MICROTIME', microtime(true));
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));
define('ROOT_PATH', dirname(__DIR__));
// Setup autoloading
require 'init_autoloader.php';
// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();


