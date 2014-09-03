<?php
	return
	[
	    'controllers' =>
	    [
	        'invokables' =>
	        [
	            'AdminController' => 'Admin\Controller\AdminController'        
	        ]
	    ],
	    'router' =>
	    [
	        'routes' =>
	        [
	            'admin' =>	
	            [
	            	'type' => 'segment',
	            	'options' =>
	            	[
	            		'route'    => '/admin/[:action]',
	                    'constraints' =>
	                    [
	                        'action' => '(addproduct)|(editproduct)|(editorder)',
	                    ],
	                    'defaults' =>
	                    [
	                        'controller' => 'MosaicController',
	                        'action'     => 'home',
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
