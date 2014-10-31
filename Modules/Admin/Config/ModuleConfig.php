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
	                        'action' => '(addproduct)|(orders)|(deleteproduct)|(editorder)',
	                    ],
	                    'defaults' =>
	                    [
	                        'controller' => 'AdminController',
	                    ],
					],
				],
	            'editproduct' =>
	            [
	            	'type' => 'segment',
	            	'options' =>
	            	[
	            		'route'    => '/admin/editproduct/[:productid]',
	                    'constraints' =>
	                    [
	                        'productid' => '[1-9]{1}[0-9]*',
	                    ],
	                    'defaults' =>
	                    [
	                        'controller' => 'AdminController',
	                        'action' => 'editproduct'
	                    ],
					],
				],
	            'editproduct' =>
	            [
	            	'type' => 'segment',
	            	'options' =>
	            	[
	            		'route'    => '/admin/deleteproduct/[:productid]',
	                    'constraints' =>
	                    [
	                        'productid' => '[1-9]{1}[0-9]*',
	                    ],
	                    'defaults' =>
	                    [
	                        'controller' => 'AdminController',
	                        'action' => 'deleteproduct'
	                    ],
					],
				],
	        ],
	    ],
	    'view_manager' =>
	    [
	        'template_path_stack' =>
	        [
	            'Admin' => __DIR__ . '/../Views/',          
	        ]
	    ],
	];
?>
