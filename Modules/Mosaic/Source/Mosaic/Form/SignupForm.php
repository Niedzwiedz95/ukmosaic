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
            /*$this->add(
            [
                'name' => 'AcceptToS',
                'attributes' =>
                [
                    'type' => 'checkbox',
                    'id' => 'acceptToS',
                    'required' => 'required'
                ],
                'options' => ['label' => 'I have read and agree to the <a href="/user/tos">Terms of Service</a>']
            ]);*/
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
			
			// Personal data.
			$this->add(
			[
	            'name' => 'firstName',
	            'attributes' =>
	            [
	                'type'  => 'text',
	                'id' => 'firstName',
                    'required' => 'required',
	        	],
	            'options' => ['label' => 'First name']
	        ]);
			$this->add(
			[
	            'name' => 'lastName',
	            'attributes' =>
	            [
	                'type'  => 'text',
	                'id' => 'lastName',
                    'required' => 'required',
	        	],
	            'options' => ['label' => 'Last name']
	        ]);
			$this->add(
			[
	            'name' => 'postalCode',
	            'attributes' =>
	            [
	                'type'  => 'text',
	                'id' => 'postalCode',
                    'required' => 'required',
	        	],
	            'options' => ['label' => 'Postal code']
	        ]);
			$this->add(
			[
	            'name' => 'city',
	            'attributes' =>
	            [
	                'type'  => 'text',
	                'id' => 'city',
                    'required' => 'required',
	        	],
	            'options' => ['label' => 'City']
	        ]);
			$this->add(
			[
	            'name' => 'street',
	            'attributes' =>
	            [
	                'type'  => 'text',
	                'id' => 'street',
                    'required' => 'required',
	        	],
	            'options' => ['label' => 'Street']
	        ]);
			$this->add(
			[
	            'name' => 'houseNumber',
	            'attributes' =>
	            [
	                'type'  => 'text',
	                'id' => 'houseNumber',
                    'required' => 'required',
	        	],
	            'options' => ['label' => 'House number']
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
            /* Get parent's input filter and create new factory. */
            $InputFilter = parent::getInputFilter();
            $Factory = new InputFactory();
            
            /* Create the necessary inputs' specifications. */
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
            
            / Add the inputs to the input filter and return it. /
            $InputFilter->add($Factory->createInput($AcceptToS));
            $InputFilter->add($Factory->createInput($SubmitSignup));
            return $InputFilter;*/return null;
        }
    }