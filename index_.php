<?php
defined('START') OR define('START',TRUE);
defined('APPPATH') OR define('APPPATH','applications');
defined('SYSTEMPATH') OR define('SYSTEMPATH','main');
defined('VENDORSPATH') OR define('VENDORSPATH','vendors');
chdir(__DIR__);

if(!defined('DS')) define('DS', DIRECTORY_SEPARATOR);
if(!defined('EXT')) define('EXT','.php');

require SYSTEMPATH.DS.'strap'.EXT;

/*
     define('MY_BASE_PATH', (string) (__DIR__ . '/'));
    // Set include path
    $path = (string) get_include_path();
    $path .= (string) (PATH_SEPARATOR . MY_BASE_PATH . 'php_class/');
    $path .= (string) (PATH_SEPARATOR . MY_BASE_PATH . 'php_global_class/');
    // $path .= (string) (PATH_SEPARATOR . 'additional/path/');
    set_include_path($path);

    spl_autoload_register(function ($className) {
        $className = (string) str_replace('\\', DIRECTORY_SEPARATOR, $className);
        include_once($className . '.class.php');
    }); */