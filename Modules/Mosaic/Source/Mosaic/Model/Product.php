<?php
	namespace Mosaic\Model;
	
	use Zend\InputFilter\Factory as InputFactory;
	use Zend\InputFilter\InputFilter;
	use Zend\InputFilter\InputFilterAwareInterface;
	use Zend\InputFilter\InputFilterInterface;
    use Zend\Validator;
	use Zend\Db\Adapter\Adapter;
	
	use Core\Model\BaseModel;
	
	/**	Product, that is a tile, mosaic, etc. */
    class Product extends BaseModel implements InputFilterAwareInterface
    {
		// Properties.
		protected $ProductID;
		protected $ProductName;
		protected $Category;
		protected $Path;
		protected $Description;
		protected $Price;
		protected $PriceSquareLoose;
		protected $PriceSquareAssembled;
		protected $PriceLinearLoose;
		protected $PriceLinearAssembled;
		protected $Price1x1;
		protected $Price2x2;
		protected $Price25x25;
		
		/** Builds up the product details that are displayed on the product page. */
		public function getProductDetails()
		{
			// Variable that holds the product's description.
			$Details = '<h1>' . $this->getProductName() . '</h1>';
			$Details .= '<h2>' . $this->getDescription() . '</h2>';
			
			// Variables that 
			$Standard = '';
			$Square = '';
			$Linear = '';
			$MosaicDesigns = '';
			
			// Build up the product's description.
			if($this->getPrice() != null)
			{
				$Standard = '<h3>Standard</h3>';
				$Standard .= "<p>Standard - £<span class='pricePrice'>" . $this->getPrice() . '</span></p>';
				$Details .= "<div class='col-lg-12'>$Standard</div>";
			}
			if($this->getPriceSquareLoose() != null || $this->getPriceSquareAssembled() != null)
			{
				$Square = '<h3>Field per square metre</h3>';
				$Square .= $this->getPriceSquareLoose() != null ? "<p>Loose Tiles - £<span class='pricePriceSquareLoose'>" . $this->getPriceSquareLoose() . '</span></p>' : '';
				$Square .= $this->getPriceSquareAssembled() != null ? "<p>Assembled Tiles - £<span class='pricePriceSquareAssembled'>" . $this->getPriceSquareAssembled() . '</span></p>' : '';
				$Details .= "<div class='col-lg-12'>$Square</div>";
			}
			if($this->getPriceLinearLoose() != null || $this->getPriceLinearAssembled() != null)
			{
				$Linear = '<h3>Border per linear metre</h3>';
				$Linear .= $this->getPriceLinearLoose() != null ? "<p>Loose Tiles - £<span class='pricePriceLinearLoose'>" . $this->getPriceLinearLoose() . '</span></p>' : '';
				$Linear .= $this->getPriceLinearAssembled() != null ? "<p>Assembled Borders - £<span class='pricePriceLinearAssembled'>" . $this->getPriceLinearAssembled() . '</span></p>' : '';
				$Details .= "<div class='col-lg-12'>$Linear</div>";
			}
			if($this->getPrice1x1() != null || $this->getPrice2x2() != null || $this->getPrice25x25() != null)
			{
				$MosaicDesigns = '<h3>Mosaic Designs</h3>';
				$MosaicDesigns .= $this->getPrice1x1() != null ? "<p>Size 1x1 - £<span class='pricePrice1x1'>" . $this->getPrice1x1() . '</span></p>' : '';
				$MosaicDesigns .= $this->getPrice2x2() != null ? "<p>Size 2x2 - £<span class='pricePrice2x2'>" . $this->getPrice2x2() . '</span></p>' : '';
				$MosaicDesigns .= $this->getPrice25x25() != null ? "<p>Size 2.5x2.5 - £<span class='pricePrice25x25'>" . $this->getPrice25x25() . '</span></p>' : '';
				$Details .= "<div class='col-lg-12'>$MosaicDesigns</div>";
			}
			
			return $Details;
		}
		
		/** Builds up a value_options array used in constructing the AddToCartForm instance. */
		public function getValueOptions()
		{
			// Create an empty array to store the options.
			$ValueOptions = [];
			
			// Build up the array.
			if($this->getPrice() != null)
			{
				$ValueOptions['Standard']['Price'] = 'Standard';
			}
			if($this->getPriceSquareLoose() != null)
			{
				$ValueOptions['Field per square metre']['PriceSquareLoose'] = 'Loose Tiles';
			}
			if($this->getPriceSquareAssembled() != null)
			{
				$ValueOptions['Field per square metre']['PriceSquareAssembled'] = 'Assembled Tiles';
			}
			if($this->getPriceLinearLoose() != null)
			{
				$ValueOptions['Border per linear metre']['PriceLinearLoose'] = 'Loose Tiles';
			}
			if($this->getPriceLinearAssembled() != null)
			{
				$ValueOptions['Border per linear metre']['PriceLinearAssembled'] = 'Assembled Borders';
			}
			if($this->getPrice1x1() != null)
			{
				$ValueOptions['Mosaic Designs']['Price1x1'] = 'Size 1x1';
			}
			if($this->getPrice2x2() != null)
			{
				$ValueOptions['Mosaic Designs']['Price2x2'] = 'Size 2x2';
			}
			if($this->getPrice25x25() != null)
			{
				$ValueOptions['Mosaic Designs']['Price2.5x2.5'] = 'Size 2.5x2.5';
			}
			
			// Return the options array.
			return $ValueOptions;
		}

		/** Provides the appropriate input filter for the product. */
		public function getInputFilter()
		{
			// Create the input filter and input factory instances.
            $InputFilter = new InputFilter();
            $Factory = new InputFactory();
            
			// Create the validator specifications.
            $ProductName =
            [
                'name' => 'productName',
                'required' => true,
                'filters' =>
                [
                	['name' => 'StripTags'],
                	['name' => 'StringTrim']
            	],
                'validators' =>
                [
                    [
                        'name' => 'NotEmpty',
                        'options' =>
                        [
                            'messages' =>
                            [
                                'isEmpty' => 'This field is required.'
                            ]
                        ]
                    ],
                    [
                    	'name' => 'StringLength',
                    	'options' =>
                    	[
                    		'max' => 64,
                    		'messages' =>
                    		[
                    			'stringLengthTooLong' => 'The product name must not be longer than 64 characters!'
                    		]
                    	]
                    ]
                ],
            ];
            $Category =
            [
                'name' => 'category',
                'required' => true,
                'filters' =>
                [
                	['name' => 'StripTags'],
                	['name' => 'StringTrim']
            	],
                'validators' =>
                [
                    [
                        'name' => 'Regex',
                        'options' =>
                        [
                        	'pattern' => '/^(unglazed_tiles15x15-9mm)|(unglazed_octagon10x10-9mm)|(unglazed_tiles5x5-9mm)|'.
                        	             '(unglazed_tiles2x2-3.8mm)|(unglazed_tiles10x10-9mm)|(unglazed_victorian-9mm)' .
                        	             '|(unglazed_basket)|(unglazed_tiles7x7-9mm)|(unglazed_tiles3.5x3.5-9mm)|' .
                        	             '(unglazed_octagon15x15-9mm)|(satin&matt_tiles2.5x2.5-cmm)|(glazed_tiles2.5x2.5-cmm)|' .
                        	             '(mosaicdesigns_mosaicdesigns)|(unglazed_tiles5x5-5mm)$/',
                            'messages' =>
                            [
                                \Zend\Validator\Regex::INVALID => 'Ivalid categroy chosen.'
                            ]
                        ]
                    ]
                ],
            ];
            $Description =
            [
                'name' => 'description',
                'required' => true,
                'filters' =>
                [
                	['name' => 'StripTags'],
                	['name' => 'StringTrim']
            	],
                'validators' =>
                [
                    [
                        'name' => 'NotEmpty',
                        'options' =>
                        [
                            'messages' =>
                            [
                                'isEmpty' => 'This field is required.'
                            ]
                        ]
                    ],
                    [
                    	'name' => 'StringLength',
                    	'options' =>
                    	[
                    		'max' => 255,
                    		'messages' =>
                    		[
                    			'stringLengthTooLong' => 'The description must be shorter than 255 characters!'
                    		]
                    	]
                    ]
                ],
            ];
            $Price =
            [
                'name' => 'price',
                'filters' =>
                [
                	['name' => 'StripTags'],
                	['name' => 'StringTrim']
            	],
                'validators' =>
                [
                    [
                        'name' => 'Zend\I18n\Validator\Float',
                        'options' =>
                        [
                            'messages' =>
                            [
                                \Zend\I18n\Validator\Float::INVALID => 'This field must contain an integer or a decimal value!'
                            ]
                        ]
                    ],
                ],
            ];
            $PriceSquareLoose =
            [
                'name' => 'priceSquareLoose',
                'filters' =>
                [
                	['name' => 'StripTags'],
                	['name' => 'StringTrim']
            	],
                'validators' =>
                [
                    [
                        'name' => 'Zend\I18n\Validator\Float',
                        'options' =>
                        [
                            'messages' =>
                            [
                                \Zend\I18n\Validator\Float::INVALID => 'This field must contain an integer or a decimal value!'
                            ]
                        ]
                    ],
                ],
            ];
            $PriceSquareAssembled =
            [
                'name' => 'priceSquareAssembled',
                'filters' =>
                [
                	['name' => 'StripTags'],
                	['name' => 'StringTrim']
            	],
                'validators' =>
                [
                    [
                        'name' => 'Zend\I18n\Validator\Float',
                        'options' =>
                        [
                            'messages' =>
                            [
                                \Zend\I18n\Validator\Float::INVALID => 'This field must contain an integer or a decimal value!'
                            ]
                        ]
                    ],
                ],
            ];
            $PriceLinearLoose =
            [
                'name' => 'priceLinearLoose',
                'filters' =>
                [
                	['name' => 'StripTags'],
                	['name' => 'StringTrim']
            	],
                'validators' =>
                [
                    [
                        'name' => 'Zend\I18n\Validator\Float',
                        'options' =>
                        [
                            'messages' =>
                            [
                                \Zend\I18n\Validator\Float::INVALID => 'This field must contain an integer or a decimal value!'
                            ]
                        ]
                    ],
                ],
            ];
            $PriceLinearAssembled =
            [
                'name' => 'priceLinearAssembled',
                'filters' =>
                [
                	['name' => 'StripTags'],
                	['name' => 'StringTrim']
            	],
                'validators' =>
                [
                    [
                        'name' => 'Zend\I18n\Validator\Float',
                        'options' =>
                        [
                            'messages' =>
                            [
                                \Zend\I18n\Validator\Float::INVALID => 'This field must contain an integer or a decimal value!'
                            ]
                        ]
                    ],
                ],
            ];
            $Price1x1 =
            [
                'name' => 'price1x1',
                'filters' =>
                [
                	['name' => 'StripTags'],
                	['name' => 'StringTrim']
            	],
                'validators' =>
                [
                    [
                        'name' => 'Zend\I18n\Validator\Float',
                        'options' =>
                        [
                            'messages' =>
                            [
                                \Zend\I18n\Validator\Float::INVALID => 'This field must contain an integer or a decimal value!'
                            ]
                        ]
                    ],
                ],
            ];
            $Price2x2 =
            [
                'name' => 'price2x2',
                'filters' =>
                [
                	['name' => 'StripTags'],
                	['name' => 'StringTrim']
            	],
                'validators' =>
                [
                    [
                        'name' => 'Zend\I18n\Validator\Float',
                        'options' =>
                        [
                            'messages' =>
                            [
                                \Zend\I18n\Validator\Float::INVALID => 'This field must contain an integer or a decimal value!'
                            ]
                        ]
                    ],
                ],
            ];
            $Price25x25 =
            [
                'name' => 'price25x25',
                'filters' =>
                [
                	['name' => 'StripTags'],
                	['name' => 'StringTrim']
            	],
                'validators' =>
                [
                    [
                        'name' => 'Zend\I18n\Validator\Float',
                        'options' =>
                        [
                            'messages' =>
                            [
                                \Zend\I18n\Validator\Float::INVALID => 'This field must contain an integer or a decimal value!'
                            ]
                        ]
                    ],
                ],
            ];
            
            // Assemble the input filter and return it.
            $InputFilter->add($Factory->createInput($ProductName));
            $InputFilter->add($Factory->createInput($Category));
            $InputFilter->add($Factory->createInput($Description));
            $InputFilter->add($Factory->createInput($Price));
            $InputFilter->add($Factory->createInput($PriceSquareLoose));
            $InputFilter->add($Factory->createInput($PriceSquareAssembled));
            $InputFilter->add($Factory->createInput($PriceLinearLoose));
            $InputFilter->add($Factory->createInput($PriceLinearAssembled));
            $InputFilter->add($Factory->createInput($Price1x1));
            $InputFilter->add($Factory->createInput($Price2x2));
            $InputFilter->add($Factory->createInput($Price25x25));
            return $InputFilter;	
		}
    }
?>