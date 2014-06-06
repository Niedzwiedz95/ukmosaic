<?php
    /* Config of the Core module. */
	return
	[
        'view_manager' =>
	    [
	        'display_not_found_reason' => true,
	        'display_exceptions'       => true,
	        'not_found_template'       => 'Error/404',
	        'exception_template'       => Debug == true ? 'Error/Index' : 'Error/Error', //TODO
	        'template_map' =>
	        [
	            'layout/layout'           => 'Modules/Core/Views/Layout/Layout.phtml',
	            'Error/404'               => __DIR__ . '/../Views/Errors/404.phtml',
	            //'Error/Index'             => 'Modules/Core/Views/Errors/Error.phtml',
	            'Error/Index'             => __DIR__ . '/../Views/Errors/Index.phtml',
	        ],
	        'template_path_stack' =>
	        [
	            //'Core' => 'Modules/Core/Views/',
	            //'Mosaic' => 'Modules/Mosaic/Views/',
	        ],
	        'strategies' =>
	        [
            	'ViewJsonStrategy'
            ]
	    ],
	];
?>