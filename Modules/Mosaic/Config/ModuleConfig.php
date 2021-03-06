<?php
	return
	[
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
	                        'action' => '(home)|(specialoffers)|(information)|(contact)|(product)|(productsjson)|(signup)|
	                        			 (tos)|(cart)|(checkout)|(payment)',
	                    ],
	                    'defaults' =>
	                    [
	                        'controller' => 'MosaicController',
	                        'action'     => 'home',
	                    ],
					],
				],
	            'mosaic/catalogue' =>	
	            [
	            	'type' => 'segment',
	            	'options' =>
	            	[
	            		'route'    => '/catalogue[/:category]',
	                    'constraints' =>
	                    [
							'category' => '.*',
	                    ],
	                    'defaults' =>
	                    [
	                        'controller' => 'MosaicController',
	                        'action'     => 'catalogue',
	                    ],
					],
				],
	            'technical' =>	
	            [
	            	'type' => 'segment',
	            	'options' =>
	            	[
	            		'route'    => '/technical/:technicalparam',
	                    'constraints' =>
	                    [
							'technicalparam' => '(winckelmans)|(briare)',
	                    ],
	                    'defaults' =>
	                    [
	                        'controller' => 'MosaicController',
	                        'action'     => 'technical',
	                        'technicalparam' => 'winckelmans',
	                    ],
					],
				],
	            'accessories' =>	
	            [
	            	'type' => 'segment',
	            	'options' =>
	            	[
	            		'route'    => '/accessories/:accessoriesparam',
	                    'constraints' =>
	                    [
							'accessoriesparam' => '(decorative1)|(decorative2)',
	                    ],
	                    'defaults' =>
	                    [
	                        'controller' => 'MosaicController',
	                        'action'     => 'accessories',
	                        'accessoriesparam' => 'decorative1',
	                    ],
					],
				],
	            'product' =>	
	            [
	            	'type' => 'segment',
	            	'options' =>
	            	[
	            		'route'    => '/product/:productid',
	                    'constraints' =>
	                    [
							'productid' => '[1-9]{1}[0-9]*',
	                    ],
	                    'defaults' =>
	                    [
	                        'controller' => 'MosaicController',
	                        'action'     => 'product'
	                    ],
					],
				],
	            'cart/remove' =>	
	            [
	            	'type' => 'segment',
	            	'options' =>
	            	[
	            		'route'    => '/cart/remove/:productid/:producttype',
	                    'defaults' =>
	                    [
	                        'controller' => 'MosaicController',
	                        'action'     => 'cartremove'
	                    ],
					],
				],
	            'ship' =>	
	            [
	            	'type' => 'segment',
	            	'options' =>
	            	[
	            		'route'    => '/ship/:addressid',
	                    'defaults' =>
	                    [
	                        'controller' => 'MosaicController',
	                        'action'     => 'ship'
	                    ],
					],
				],
	            'order' =>	
	            [
	            	'type' => 'segment',
	            	'options' =>
	            	[
	            		'route'    => '/order/:orderid',
	                    'defaults' =>
	                    [
	                        'controller' => 'MosaicController',
	                        'action'     => 'order'
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
