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
	                        'action' => '(signin)|(signout)|(signup)|(account)|(addressbook)|(orders)|(addaddress)|(restorepassword)',
	                    ],
	                    'defaults' =>
	                    [
	                        'controller' => 'UserController',
	                    ]
					]
				],
	            'edit&delete' =>	
	            [
	            	'type' => 'segment',
	            	'options' =>
	            	[
	            		'route'    => '/user/:action[/][:addressid]',
	                    'constraints' =>
	                    [
	                    	'action' => '(editaddress)|(deleteaddress)',
	                        'addressid' => '[1-9]+[0-9]*',
	                    ],
	                    'defaults' =>
	                    [
	                        'controller' => 'UserController',
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