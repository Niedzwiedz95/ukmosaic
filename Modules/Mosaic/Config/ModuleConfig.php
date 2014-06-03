<?php
    /* Config of the Mosaic module. */
	return
	[
        /* List of all controllers in the User module. */
	    'controllers' =>
	    [
	        'invokables' =>
	        [
	            'MosaicController' => 'Mosaic\Controller\MosaicController'        
	        ]
	    ],
	    'router' =>
	    [
	        'routes' =>
	        [
	            'mosaic' =>	
	            [
	            	'type' => 'segment',
	            	'options' =>
	            	[
	            		'route'    => '/[:action]',
	                    'constraints' =>
	                    [
	                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
	                    ],
	                    'defaults' =>
	                    [
	                        'controller' => 'MosaicController',
	                        'action'     => 'home'
	                    ],
					],
				],
	        ],
	    ],
	    'view_manager' =>
	    [
	        'template_path_stack' =>
	        [
	            'Mosaic' => __DIR__ . '/../Views/',          
	        ]
	    ],
	];
?>