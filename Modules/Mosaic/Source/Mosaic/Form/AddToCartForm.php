<?php
    namespace Mosaic\Form;
    
    use Zend\Form\Form;
    use Zend\Validator;
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    use Zend\Validator\File;

    use Core\Form\BaseForm;
	
	use Mosaic\Model\Product;
    
    class AddToCartForm extends BaseForm
    {
    	// Properties.
    	protected $Product;
		
        /** Construct the form. */
        public function __construct(Product $Product)
        {
            // Set all the necessary attributes.
            parent::__construct('AddToCartForm');
            $this->setAttribute('id', 'addToCartForm');
            $this->setAttribute('action', '/product/' . $Product->getProductID());
			
			// Set the product instance.
			$this->Product = $Product;

            // Create the necessary elements.
            // A hidden element whose value is the product's id.
            $this->add(
            [
                'name' => 'productID',
                'attributes' =>
                [
                   'type'  => 'hidden',
                   'id' => 'productID',
                   'value' => $this->getProduct()->getProductID(),
                   'required' => 'required',
                ],
            ]);
            if(array_key_exists('Standard', $this->getProduct()->buildValueOptions()))
			{
				$this->add(
	            [
	                'name' => 'typeStandard',
	                'attributes' =>
	                [
	                   'type'  => 'Zend\Form\Element\Radio',
	                   'id' => 'typeStandard',
	                ],
	                'options' =>
	                [
	                	'header' => 'Standard',
	                	'value_options' => $this->getProduct()->buildValueOptions()['Standard']
	            	]
	            ]);
	            $this->add(
	            [
	                'name' => 'amountStandard',
	                'attributes' =>
	                [
	                   'type'  => 'number',
	                   'id' => 'amountStandard',
	                   'value' => 1,
	                   'min' => 1
	                ],
	                'options' =>
	                [
	                	'label' => 'm²',
	            	]
	            ]);
			}
            if(array_key_exists('Field per square metre', $this->getProduct()->buildValueOptions()))
			{
	            $this->add(
	            [
	                'name' => 'typeSquare',
	                'attributes' =>
	                [
	                   'type'  => 'Zend\Form\Element\Radio',
	                   'id' => 'typeSquare',
	                ],
	                'options' =>
	                [
	                	'header' => 'Field per square metre',
	                	'value_options' => $this->getProduct()->buildValueOptions()['Field per square metre']
	            	]
	            ]);
	            $this->add(
	            [
	                'name' => 'amountSquare',
	                'attributes' =>
	                [
	                   'type'  => 'number',
	                   'id' => 'amountSquare',
	                   'value' => 1,
	                   'min' => 1
	                ],
	                'options' =>
	                [
	                	'label' => 'm²',
	            	]
            	]);
			}
            if(array_key_exists('Border per linear metre', $this->getProduct()->buildValueOptions()))
			{
	            $this->add(
	            [
	                'name' => 'typeLinear',
	                'attributes' =>
	                [
	                   'type'  => 'Zend\Form\Element\Radio',
	                   'id' => 'typeLinear',
	                ],
	                'options' =>
	                [
	                	'header' => 'Border per linear metre',
	                	'value_options' => $this->getProduct()->buildValueOptions()['Border per linear metre']
	            	]
	            ]);
	            $this->add(
	            [
	                'name' => 'amountLinear',
	                'attributes' =>
	                [
	                   'type'  => 'number',
	                   'id' => 'amountLinear',
	                   'value' => 1,
	                   'min' => 1
	                ],
	                'options' =>
	                [
	                	'label' => 'm',
	            	]
	            ]);
            }
            if(array_key_exists('Mosaic Designs', $this->getProduct()->buildValueOptions()))
			{
	            $this->add(
	            [
	                'name' => 'typeMosaicDesigns',
	                'attributes' =>
	                [
	                   'type'  => 'Zend\Form\Element\Radio',
	                   'id' => 'typeMosaicDesigns',
	                ],
	                'options' =>
	                [
	                	'header' => 'Mosaic Designs',
	                	'value_options' => $this->getProduct()->buildValueOptions()['Mosaic Designs']
	            	]
	            ]);
	            $this->add(
	            [
	                'name' => 'amountMosaicDesigns',
	                'attributes' =>
	                [
	                   'type'  => 'number',
	                   'id' => 'amountMosaicDesigns',
	                   'value' => 1,
	                   'min' => 1
	                ],
	                'options' =>
	                [
	                	'label' => 'm²',
	            	]
	            ]);
            }
            $this->add(
            [
                'name' => 'submitAddToCartForm',
                'attributes' =>
                [
                    'type'  => 'submit',
                    'id' => 'submitAddToCartForm',
                    'required' => 'required',
                    'value' => 'Add to cart',
                ]
            ]);
        }

        /** Returns the input filter appropriate for the current form. */
        public function getInputFilter()
        {
        	parent::getInputFilter();
            // Create new InputFilter and InputFactory instances.
            $InputFilter = new InputFilter();
            $Factory = new InputFactory();
			
			// Create the necessary validators' specifications.
            $ProductID =
            [
                'name' => 'productID',
                'required' => true,
                'filters'  =>
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
                    ]
                ]
            ];
			// Standard (the product that has a single Price)
            $TypeStandard =
            [
                'name' => 'typeStandard',
                'filters'  =>
                [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ]
            ];
            $AmountStandard =
            [
                'name' => 'amountStandard',
                'filters'  =>
                [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators' =>
                [
                    [
                        'name' => 'Zend\Validator\Between',
                        'options' =>
                        [
                        	'min' => 1,
                            'messages' =>
                            [
                                'notBetween' => 'You must purchase at least one square meter of tiles'
                            ]
                        ]
                    ],
                    [
                        'name' => 'NotEmpty',
                        'options' =>
                        [
                            'messages' =>
                            [
                                'isEmpty' => "This field is required."
                            ]
                        ]
                    ],
                ]
            ];
			// Square (products that have PriceSquareLoose and PriceSquareAssembled).
            $TypeSquare =
            [
                'name' => 'typeSquare',
                'filters'  =>
                [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ]
            ];
            $AmountSquare =
            [
                'name' => 'amountSquare',
                'filters'  =>
                [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators' =>
                [
                    [
                        'name' => 'Zend\Validator\Between',
                        'options' =>
                        [
                        	'min' => 1,
                            'messages' =>
                            [
                                'notBetween' => 'You must purchase at least one square meter of tiles'
                            ]
                        ]
                    ],
                    [
                        'name' => 'NotEmpty',
                        'options' =>
                        [
                            'messages' =>
                            [
                                'isEmpty' => "This field is required."
                            ]
                        ]
                    ],
                ]
            ];
			// Linear (products that have PriceLinearLoose and PriceLinearAssembled).
            $TypeLinear =
            [
                'name' => 'typeLinear',
                'filters'  =>
                [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ]
            ];
            $AmountLinear =
            [
                'name' => 'amountLinear',
                'filters'  =>
                [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators' =>
                [
                    [
                        'name' => 'Zend\Validator\Between',
                        'options' =>
                        [
                        	'min' => 1,
                            'messages' =>
                            [
                                'notBetween' => 'You must purchase at least one square meter of tiles'
                            ]
                        ]
                    ],
                    [
                        'name' => 'NotEmpty',
                        'options' =>
                        [
                            'messages' =>
                            [
                                'isEmpty' => "This field is required."
                            ]
                        ]
                    ],
                ]
            ];
			// MosaicDesigns (products that have Price1x1, Price2x2 and Price2.5x2.5)/
            $TypeMosaicDesigns =
            [
                'name' => 'typeMosaicDesigns',
                'filters'  =>
                [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ]
            ];
            $AmountMosaicDesigns =
            [
                'name' => 'amountMosaicDesigns',
                'filters'  =>
                [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators' =>
                [
                    [
                        'name' => 'Zend\Validator\Between',
                        'options' =>
                        [
                        	'min' => 1,
                            'messages' =>
                            [
                                'notBetween' => 'You must purchase at least one square meter of tiles'
                            ]
                        ]
                    ],
                    [
                        'name' => 'NotEmpty',
                        'options' =>
                        [
                            'messages' =>
                            [
                                'isEmpty' => "This field is required."
                            ]
                        ]
                    ],
                ]
            ];
			// Submit button.
            $SubmitAddToCartForm = 
            [
                'name' => 'submitAddToCartForm',
                'required' => true,
            ];
			
			// Assemble the input filter. The first entry is the CSRF input specification.
			$InputFilter->add($this->getCsrfInputSpecification());
			$InputFilter->add($ProductID);
			$InputFilter->add($TypeStandard);
			$InputFilter->add($AmountStandard);
			$InputFilter->add($TypeSquare);
			$InputFilter->add($AmountSquare);
			$InputFilter->add($TypeLinear);
			$InputFilter->add($AmountLinear);
			$InputFilter->add($TypeMosaicDesigns);
			$InputFilter->add($AmountMosaicDesigns);
			$InputFilter->add($SubmitAddToCartForm);			
            return $InputFilter;
        }

        /** Validate the form - check whether at least one type of tiles was selected. */
        public function isValid()
        {
        	// Check whether each of the tile types was chosen.
        	$TypeStandardSet = $this->has('typeStandard') ? $this->get('typeStandard')->getValue() != null : false;
        	$TypeSquareSet = $this->has('typeSquare') ? $this->get('typeSquare')->getValue() != null : false;
        	$TypeLinearSet = $this->has('typeLinear') ? $this->get('typeLinear')->getValue() != null : false;
        	$TypeMosaicDesigns = $this->has('typeMosaicDesigns') ? $this->get('typeMosaicDesigns')->getValue() != null : false;
			
			// Check whether any type of tiles was chosen.
			$TypeChosen = $TypeStandardSet || $TypeSquareSet || $TypeLinearSet || $TypeMosaicDesigns;

			if($TypeChosen == false)
			{
				$Messages = $this->getMessages();
			}
			
			// The form is valid if the parent method validates it correctly and at least one type of tile was selected.
        	return parent::isValid() && $TypeChosen;
        }
    }
?>