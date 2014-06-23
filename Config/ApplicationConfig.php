<?php
    // Configuration of the whole site.
	return
	[
        // Contains the list of all modules in the site.
	    'modules' =>
	    [
            'Core',
            'Mosaic'
	    ],
	    'module_listener_options' =>
	    [
            // Configuration paths.
	        'config_glob_paths' =>
	        [
	            'Config/Autoload/{,*.}{Global,Local}.php',
	        ],
	        // Paths to site modules (./Modules) and Zend Framework 2 and other modules (./Vendor).
	        'module_paths' =>
	        [
	            './Modules',
	            './vendor',
	        ],
	    ],
        'service_manager' =>
        [
            'factories' =>
            [
                //'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
                'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
            ],
        ],
	];
?>