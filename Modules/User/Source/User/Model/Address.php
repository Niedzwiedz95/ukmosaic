<?php
	namespace User\Model;
	
	use Zend\InputFilter\Factory as InputFactory;
	use Zend\InputFilter\InputFilter;
	use Zend\InputFilter\InputFilterAwareInterface;
	use Zend\InputFilter\InputFilterInterface;
    use Zend\Validator;
	use Zend\Db\Adapter\Adapter;
	
	use Core\Model\BaseModel;
	
	/**	Product, that is a tile, mosaic, etc. */
    class Address extends BaseModel
    {
		// Properties.
		protected $AddressID;
		protected $FullName;
		protected $Street;
		protected $Locality;
		protected $PostTown;
		protected $Postcode;
		
        /** Returns an InputFilter that can verify the correctness of the address's attributes and can be later
         *  extended. */
         public function getInputFilter()
		 {
            // Create the input filter and input factory instances.
            $InputFilter = new InputFilter();
            $Factory = new InputFactory();
            
		 	// Personal information.
			$FullName = 
			[
				'name' => 'fullName',
				'required' => true,
                'filters'  =>
                [
                    ['name' => 'StripTags'],
                ],
                'validators' =>
                [
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
                    [
                    	'name' => 'StringLength',
                    	'options' =>
                    	[
                    		'max' => 256,
                    		'messages' =>
                    		[
                    			'stringLengthTooLong' => 'This field must not be longer than 256 characters!'
                    		]
                    	]
                    ]
                ]
			];
			$Street = 
			[
				'name' => 'street',
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
                                'isEmpty' => "This field is required."
                            ]
                        ]
                    ],
                    [
                    	'name' => 'StringLength',
                    	'max' => 256,
                    	'options' =>
                    	[
                    		'messages' =>
                    		[
                    			'stringLengthTooLong' => 'This field must not be longer than 256 characters!'
                    		]
                    	]
                    ]
                ]
			];
			$Locality = 
			[
				'name' => 'locality',
				'required' => false,
                'filters'  =>
                [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators' =>
                [
                    [
                    	'name' => 'StringLength',
                    	'max' => 256,
                    	'options' =>
                    	[
                    		'messages' =>
                    		[
                    			'stringLengthTooLong' => 'This field must not be longer than 256 characters!'
                    		]
                    	]
                    ]
                ]
			];
			$PostTown = 
			[
				'name' => 'postTown',
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
                                'isEmpty' => "This field is required."
                            ]
                        ]
                    ],
                    [
                    	'name' => 'StringLength',
                    	'max' => 256,
                    	'options' =>
                    	[
                    		'messages' =>
                    		[
                    			'stringLengthTooLong' => 'This field must not be longer than 256 characters!'
                    		]
                    	]
                    ]
                ]
			];
			$Postcode = 
			[
				'name' => 'postcode',
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
                                'isEmpty' => "This field is required."
                            ]
                        ]
                    ],
                    [
                    	'name' => 'StringLength',
                    	'max' => 256,
                    	'options' =>
                    	[
                    		'messages' =>
                    		[
                    			'stringLengthTooLong' => 'This field must not be longer than 256 characters!'
                    		]
                    	]
                    ]
                ]
			];
			
            // Assemble the input filter and return it.
            $InputFilter->add($Factory->createInput($FullName));
            $InputFilter->add($Factory->createInput($Street));
            $InputFilter->add($Factory->createInput($Locality));
            $InputFilter->add($Factory->createInput($PostTown));
            $InputFilter->add($Factory->createInput($Postcode));
            return $InputFilter;
		 }
    }
?>