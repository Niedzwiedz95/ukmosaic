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
            $this->add(
            [
                'name' => 'productType',
                'attributes' =>
                [
                   'type'  => 'select',
                   'id' => 'productType',
                   'required' => 'required'
                ],
                'options' =>
                [
                	'value_options' => $this->getProduct()->getValueOptions()
            	]
            ]);
            $this->add(
            [
                'name' => 'productAmount',
                'attributes' =>
                [
                   'type'  => 'number',
                   'id' => 'productAmount',
                   'required' => 'required',
                   'value' => 1,
                   'min' => 1
                ],
                'options' =>
                [
                	'label' => 'm²',
            	]
            ]);
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
            // Create new InputFilter and InputFactory instances.
            $InputFilter = new InputFilter();
            $Factory = new InputFactory();
			
			// Create the necessary validators' specifications.
            $ProductType =
            [
                'name' => 'productType',
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
                    ],
                ]
            ];
            $ProductAmount =
            [
                'name' => 'productAmount',
                'required' => true,
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
                                'isEmpty' => 'This field is required.'
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
			//$InputFilter->add($Factory->createInput($this->getCsrfInputSpecification()));
			$InputFilter->add($Factory->createInput($ProductType));
			$InputFilter->add($Factory->createInput($ProductAmount));
			$InputFilter->add($Factory->createInput($SubmitAddToCartForm));			
            return $InputFilter;
        }
    }
?>