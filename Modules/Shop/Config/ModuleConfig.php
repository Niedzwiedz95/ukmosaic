<?php
	return
	[
	    'controllers' =>
	    [
	        'invokables' =>
	        [
	            'ShopController' => 'Shop\Controller\ShopController'        
	        ]
	    ],
	    'router' =>
	    [
	        'routes' =>
	        [
	            'shop' =>	
	            [
	            	'type' => 'segment',
	            	'options' =>
	            	[
	            		'route'    => '/shop/[:action]',
	                    'constraints' =>
	                    [
	                        'action' => '',
	                    ]
					]
				]
	        ]
	    ],
	    'view_manager' =>
	    [
	        'template_path_stack' =>
	        [
	            'Shop' => __DIR__ . '/../Views/',          
	        ]
	    ],
	];
?>
