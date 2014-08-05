<?php
	return
	[
        // List of all controllers in the User module.
	    'controllers' =>
	    [
	        'invokables' =>
	        [
	            'UserController' => 'User\Controller\UserController'        
	        ]
	    ],
	    'router' =>
	    [
	        'routes' =>
	        [
	            'user' =>	
	            [
	            	'type' => 'segment',
	            	'options' =>
	            	[
	            		'route'    => '/user/:action',
	                    'constraints' =>
	                    [
	                        'action' => '(signin)|(signup)',
	                    ],
	                    'defaults' =>
	                    [
	                        'controller' => 'UserController',
	                    ]
					]
				]
	        ]
	    ],
	    'view_manager' =>
	    [
	        'template_path_stack' =>
	        [
	            'User' => __DIR__ . '/../Views/',       
	        ]
	    ]
	];
?>