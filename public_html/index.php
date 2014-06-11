<?php
    // All paths are relative to the project root now.
    chdir(dirname(__DIR__));
    
    // Set debug and error reporting modes based on whether the string 'localhost' is contained in the HTTP HOST.
    if(strpos($_SERVER['HTTP_HOST'], 'localhost') !== FALSE)
    {
        define('Debug', true);
        define('Test', true);
        error_reporting(E_ALL);
    }
    else
    {
        define('Debug', false);
        define('Test', false);
        error_reporting(E_ERROR);
    }
    
    // Setup autoloading.
    $Loader = include 'vendor/autoload.php';
    $Loader->add('Zend', false);
    
    // Start the session.
    session_start();
    
    // Start the site.
    Zend\Mvc\Application::init(require 'Config/ApplicationConfig.php')->run();
?>