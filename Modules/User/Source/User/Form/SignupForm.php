<?php
	namespace User\Form;
	
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    
    use Core\Form\BaseForm;
	
	use User\Model\User;
    
	/**	This class represents the form used in the process of signing up (without buying anything). */
	class SignupForm extends BaseForm
	{
		/**	Constructor, sets attributes and adds the submit element. */
	    public function __construct()
	    {
	        // Set all attributes of the form.
	        parent::__construct('SignupForm');
            $this->setAttribute('action', '/user/signup');
            $this->setAttribute('id', 'signupForm');
			
            // Add the necessary elements.
            // Account info.
            $this->add(
	        [
	            'name' => 'email',
	            'attributes' =>
	            [
	               'type'  => 'email',
	               'id' => 'email',
	               'placeholder' => 'Email',
	               'required' => 'required'
                ],
	            'options' => ['label' => 'Email']
	        ]);
			$this->add(
	        [
	            'name' => 'password',
	            'attributes' =>
	            [
	               'type'  => 'password',
	               'id' => 'password',
                   'placeholder' => 'Password',
                   'required' => 'required'
                ],
	            'options' => ['label' => 'Password'],
	        ]);
            $this->add(
	        [
	            'name' => 'rePassword',
	            'attributes' =>
	            [
	               'type'  => 'password',
	               'id' => 'rePassword',
                   'placeholder' => 'Confirm password',
                   'required' => 'required'
                ],
	            'options' => ['label' => 'Confirm password'],
	        ]);
			
			// Address data.
			$this->add(
			[
	            'name' => 'fullName',
	            'attributes' =>
	            [
	                'type'  => 'text',
	                'id' => 'fullName',
                   	'placeholder' => 'e.g. Mr A Smith',
                    'required' => 'required',
	        	],
	            'options' => ['label' => 'Full name']
	        ]);
			$this->add(
			[
	            'name' => 'street',
	            'attributes' =>
	            [
	                'type'  => 'text',
	                'id' => 'street',
                   	'placeholder' => 'e.g. 3 High Street',
                    'required' => 'required',
	        	],
	            'options' => ['label' => 'Number and street']
	        ]);
			$this->add(
			[
	            'name' => 'locality',
	            'attributes' =>
	            [
	                'type'  => 'text',
	                'id' => 'locality',
                   	'placeholder' => 'e.g. Hedge End',
                    'required' => 'required',
	        	],
	            'options' => ['label' => 'Locality (optional)']
	        ]);
			$this->add(
			[
	            'name' => 'postTown',
	            'attributes' =>
	            [
	                'type'  => 'text',
	                'id' => 'postTown',
                   	'placeholder' => 'e.g. Southampton',
                    'required' => 'required',
	        	],
	            'options' => ['label' => 'Post town']
	        ]);
			$this->add(
			[
	            'name' => 'postcode',
	            'attributes' =>
	            [
	                'type'  => 'text',
	                'id' => 'postcode',
                   	'placeholder' => 'e.g. SO31 4NG',
                    'required' => 'required',
	        	],
	            'options' => ['label' => 'Postcode']
	        ]);
			
	        // Submit button.
			$this->add(
			[
	            'name' => 'submitSignupForm',
	            'attributes' =>
	            [
	                'type'  => 'submit',
	                'id' => 'submitSignupForm',
                    'required' => 'required',
                    'value' => 'Sign up!',
	        	]
	        ]);
	    }

        /** Return the input filter appropriate for the current form. */
        public function getInputFilter()
        {
            // Get parent's input filter and create new factory.
            $InputFilter = (new User())->getInputFilter();
            $Factory = new InputFactory();
            
            // Create the additional necessary input specifications.
            // Account details.
            $Password =
            [
                'name' => 'password',
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
                        'name' => 'regex',
                        'options' =>
                        [
                            'break_chain_on_failure' => true,
                            'pattern' => '/^[\p{Latin}0-9!@#$%^&*()_+-=,.;: ]{6,32}$/',
                            'messages' =>
                            [
                                'regexNotMatch' => 'Password can contain only letters, numbers, spaces and !@#$%^&*()_+-=,.;:'
                            ]
                        ]
                    ],
                    [
                        'name' => 'StringLength',
                        'options' =>
                        [
                            'break_chain_on_failure' => true,
                            'encoding' => 'UTF-8',
                            'min' => 6,
                            'max' => 32,
                            'messages' =>
                            [
                                'stringLengthTooShort' => 'Password must be 6 to 32 characters long.',
                                'stringLengthTooLong' => 'Password must be 6 to 32 characters long.',
                            ]
                        ]
                    ]
                ],
            ];
            $RePassword = 
            [
                'name' => 'rePassword',
                'required' => true,
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
                        'name' => 'identical',
                        'options' =>
                        [
                            'token' => 'password',
                            'break_chain_on_failure' => true,
                            'messages' =>
                            [
                                'notSame' => 'Passwords do not match!'
                            ]
                        ]
                    ]
                ]
            ];
			
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
			
			// Submit button.
            $SubmitSignup = 
            [
                'name' => 'SubmitSignupForm',
                'required' => true,
            ];
            
            // Add the inputs to the input filter and return it.
            $InputFilter->add($Factory->createInput($Password));
            $InputFilter->add($Factory->createInput($RePassword));
            $InputFilter->add($Factory->createInput($FullName));
            $InputFilter->add($Factory->createInput($Street));
            $InputFilter->add($Factory->createInput($Locality));
            $InputFilter->add($Factory->createInput($PostTown));
            $InputFilter->add($Factory->createInput($Postcode));
            return $InputFilter;
        }
    }