<?php

        /** Returns the input filter appropriate for the current form. */
        public function getInputFilter()
        {
            /* Create new Credentials instance and get it's input filter. */
            $Credentials = new Credentials();
            $InputFilter = $Credentials->getInputFilter();
            
            /* Create a factory instance used to add more inputs into the form. */
            $Factory = new InputFactory();
            
            /* Create specifications of additional input validators. */
            $RePassword = 
            [
                'name' => 'RePassword',
                'required' => true,
                'validators' =>
                [
                    [
                        'name' => 'NotEmpty',
                        'options' =>
                        [
                            //'break_chain_on_failure' => true,
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
                            'token' => 'Password',
                            'break_chain_on_failure' => true,
                            'messages' =>
                            [
                                'notSame' => 'Passwords do not match!'
                            ]
                        ]
                    ]
                ]
            ];
            
            /* Add the validators to the input filter and return it. */
            $InputFilter->add($Factory->createInput($RePassword));
            return $InputFilter;
        }
        /** Check if the username and email are not taken. */
        public function isUnique()
        {
            /* Create queries and value arrays. */
            $Query1 = 'SELECT * FROM Credentials WHERE Username = ?';
            $Values1 = [$this->get('Username')->getValue()];
            $Query2 = 'SELECT * FROM Credentials WHERE Email = ?';
            $Values2 = [$this->get('Email')->getValue()];
            
            /* Check if username or email is taken. */
            $UsernameTaken = $this->getDB()->query($Query1, $Values1)->count() > 0;            
            $EmailTaken = $this->getDB()->query($Query2, $Values2)->count() > 0;
            
            /* Get error messages associated with this form. */
            $Messages = $this->getMessages();
            
            /* If the username or email are taken add appropriate error message. */                       
            if($UsernameTaken == true)
            {
                $Messages['Username']['Taken'] = 'Username already taken!';
            }
            if($EmailTaken == true)
            {
                $Messages['Email']['Taken'] = 'Email address already taken!';                
            }

            /* Update the form's error messages. */
            $this->setMessages($Messages);
            
            /* Return true if fields are filled correctly and neither username nor email is taken. */
            return !$UsernameTaken && !$EmailTaken;
        }
        /** Checks whether the form is valid or not. */
        public function isValid()
        {
            /* If form is valid and both username and email are unique, return true. Otherwise return false. */
            return parent::isValid() && $this->isUnique();
        }
	}<?php
    /* This namespace contains all forms used in the User module. */
	namespace User\Form;

    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    
    use Core\Form\BaseForm;
    
	/**	This class represents the form used in the process of adding mockrs credentials to exisiting account. */
	class CreateCredentialsForm extends CreateCredentialsBaseForm
	{
		/** Construct the form. */
	    public function __construct()
	    {
	        /* Set the necessary attributes. */
	        parent::__construct('CreateCredentialsForm');
            $this->setAttribute('action', '/user/manageaccount');
            $this->setAttribute('id', 'createCredentialsForm');
			
            /* Add the submit element. */
			$this->add(
			[
	            'name' => 'SubmitCreateCredentialsForm',
	            'attributes' =>
	            [
	                'type'  => 'submit',
	                'id' => 'submitCreateCredentialsForm',
	                'required' => 'required',
                    'value' => 'Create',
	        	]
	        ]);
	    }
        /** Returns the input filter appropriate for the current form. */
        public function getInputFilter()
        {
            /* Get parent's input filter and create new InputFactory instance. */
            $InputFilter = parent::getInputFilter();
            $Factory = new InputFactory();
            
            /* Create submit input specification. */
            $SubmitCreateCredentialsForm = 
            [
                'name' => 'SubmitCreateCredentialsForm',
                'required' => true,
            ];
            
            /* Add the submit input to the input filter and return it. */
            $InputFilter->add($Factory->createInput($SubmitCreateCredentialsForm));
            return $InputFilter;
        }
    }