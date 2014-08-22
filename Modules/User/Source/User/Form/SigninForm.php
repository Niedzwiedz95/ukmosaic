<?php
	namespace User\Form;
	
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    
    use Core\Form\BaseForm;
	
	use User\Model\User;
	use User\Model\Address;
	
	use User\Model\UserTable;
    
	/**	This class represents the form used in the process of signing up (without buying anything). */
	class SigninForm extends BaseForm
	{
		// Properties.
		protected $UserTable;
		
		/**	Constructor, sets attributes and adds the submit element. */
	    public function __construct(UserTable $UserTable)
	    {
	        // Set all attributes of the form.
	        parent::__construct('SigninForm');
            $this->setAttribute('action', '/user/signin');
            $this->setAttribute('id', 'signinForm');
			$this->setAttribute('header', 'Sign in');
			
			// Set all the additional form's properties.
			$this->UserTable = $UserTable;
			
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
			
	        // Submit button.
			$this->add(
			[
	            'name' => 'submitSigninForm',
	            'attributes' =>
	            [
	                'type'  => 'submit',
	                'id' => 'submitSigninForm',
                    'required' => 'required',
                    'value' => 'Sign in',
	        	]
	        ]);
	    }

		/** Checks whether the user provided correct email and password. */
		public function isValid()
		{
			// Fetch data from the form.
			$Email = $this->get('email')->getValue();
			$Password = $this->get('password')->getValue();
			
			// Check whether the provided credentials are correct.
			if($this->getUserTable()->checkEmailAndPassword($Email, $Password))
			{
				$this->resetData();
				return true;
			}
			else
			{
				// Set a message to tell the user that the entered credentials are incorrect.
				$this->setMessages(['password' => ['Credentials' => 'Incorrect username or password!']]);
				return false;
			}
		}
    }