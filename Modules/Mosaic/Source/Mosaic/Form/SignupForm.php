<?php
	namespace Mosaic\Form;
	
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    
    use Core\Form\BaseForm;
    
	/**	This class represents the form used in the process of signing up (without buying anything). */
	class SignupForm extends BaseForm
	{
		/**	Constructor, sets attributes and adds the submit element. */
	    public function __construct()
	    {
	        // Set all attributes of the form.
	        parent::__construct('SignupForm');
            $this->setAttribute('action', '/signup');
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
			/*$this->add(
			[
	            'name' => '',
	            'attributes' =>
	            [
	                'type'  => '',
	                'id' => '',
                    'required' => '',
                    'value' => '',
	        	]
	        ]);*/
	        
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
            $InputFilter = parent::getInputFilter();
            $Factory = new InputFactory();
            
            // Create the necessary inputs' specifications.
            /*$AcceptToS =
            [
                'name' => 'AcceptToS',
                'required' => true,
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
                ]
            ];
            $SubmitSignup = 
            [
                'name' => 'SubmitSignupForm',
                'required' => true,
            ];
            
            // Add the inputs to the input filter and return it.
            $InputFilter->add($Factory->createInput($AcceptToS));
            $InputFilter->add($Factory->createInput($SubmitSignup));
            return $InputFilter;*/return null;
        }
    }