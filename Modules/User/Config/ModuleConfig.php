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
	                        'action' => '(signin)|(signout)|(signup)|(account)|(addressbook)|(orders)|(addaddress)',
	                    ],
	                    'defaults' =>
	                    [
	                        'controller' => 'UserController',
	                    ]
					]
				],
	            'user/editaddress' =>	
	            [
	            	'type' => 'segment',
	            	'options' =>
	            	[
	            		'route'    => '/user/editaddress[/][:addressid]',
	                    'constraints' =>
	                    [
	                        'addressid' => '[1-9]+[0-9]*',
	                    ],
	                    'defaults' =>
	                    [
	                        'controller' => 'UserController',
	                        'action' => 'editaddress'
	                    ]
					]
				],
	        ]
	    ],
	    'view_manager' =>
	    [
	        'template_path_stack' =>
	        [
	            'User' => __DIR__ . '/../Views/',       
	        ]
	    ],
    	'view_helpers' =>
    	[
	        'invokables'=>
	        [
	            'renderUserPanel' => 'User\View\Helper\UserPanel'  
	        ]
    	]
	];
?>