<?php
	namespace User\Model;
	
	use Zend\InputFilter\Factory as InputFactory;
	use Zend\InputFilter\InputFilter;
	use Zend\InputFilter\InputFilterAwareInterface;
	use Zend\InputFilter\InputFilterInterface;
    use Zend\Validator;
	use Zend\Db\Adapter\Adapter;
	
	use Core\Model\BaseModel;
	
	/**	A class that represents a user. */
    class User extends BaseModel
    {
		// Properties.
		protected $UserID;
		//protected $Username;
		protected $Email;
		protected $IsAdmin;
		protected $PasswordHash;
		protected $Salt;
		protected $Addresses;
		
        /** Returns an InputFilter that can verify the correctness of the user's attributes and can be later
         *  extended. */
        public function getInputFilter()
        {
            // Create the input filter and input factory instances.
            $InputFilter = new InputFilter();
            $Factory = new InputFactory();
            
            $Email =
            [
                'name' => 'email',
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
                        'name' => 'EmailAddress',
                        'options' =>
                        [
                            'encoding' => 'UTF-8',
                            'max' => 255,
                            'break_chain_on_failure' => true,
                            'messages' =>
                            [
                                'emailAddressInvalidFormat' => 'Invalid email address format.',
                                'emailAddressInvalidHostname' => 'Invalid email address format.',
                                'hostnameInvalidHostname' => 'Invalid email address format.',
                                'hostnameLocalNameNotAllowed' => 'Invalid email address format.',
                            ]
                        ]
                    ]
                ],
            ];
            
            // Assemble the input filter and return it.
            $InputFilter->add($Factory->createInput($Email));
            return $InputFilter;
        }
    }
?>