<?php
	return 
	[
		/* Contains the list of all modules to test. */
	    'modules' =>
	    [
	    	'Core',
            'Mosaic',
	    ],
	    'module_listener_options' =>
	    [
	    	/* Configuration paths. */
	        'config_glob_paths'    =>
	        [
	            '/Config/Autoload/{,*.}{Global,Local}.php',
	        ],
	        /* Paths to site modules (./Modules) and Zend Framework 2 and other modules (./vendor). */
	        'module_paths' =>
	        [
	            'Modules',
	            'vendor'
	        ],
	    ],
	];
?>