<?php
	namespace User\Form;
	
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    
    use Core\Form\BaseForm;
	
	use User\Model\User;
	use User\Model\Address;
    
	/**	This class represents the form used in the process of signing up (without buying anything). */
	class SigninForm extends BaseForm
	{
		/**	Constructor, sets attributes and adds the submit element. */
	    public function __construct()
	    {
	        // Set all attributes of the form.
	        parent::__construct('SigninForm');
            $this->setAttribute('action', '/user/signin');
            $this->setAttribute('id', 'signinForm');
			
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
    }