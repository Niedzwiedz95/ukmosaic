<?php
	namespace User\Form;
	
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    
    use Core\Form\BaseForm;
    
    use User\Model\User;
    
	class RestorePasswordForm extends BaseForm
	{
		// Properties.
		protected $UserTable;
		
		/**	Constructor, calls parent constructor and builds up the whole form. */
	    public function __construct($UserTable)
	    {
	    	// Set the necessary attributes.
	        parent::__construct('RestorePasswordForm');
            $this->setAttribute('action', '/user/restorepassword');
			$this->setAttribute('id', 'restorePasswordForm');

			// Set the UserTable property;
			$this->UserTable = $UserTable;

			// Add the necessary inputs.
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
	            'options' => ['label' => 'Email'],
	        ]);
			$this->add(
			[
	            'name' => 'submitRestorePassword',
	            'attributes' =>
	            [
	                'type'  => 'submit',
	                'id' => 'submitRestorePassword',
                    'required' => 'required',
                    'value' => 'Send me new password',
	        	]
	        ]);
		}
		
        /** Returns the InputFilter used to validate the form. No additions needed. */
        public function getInputFilter()
        {
            // Get an InputFilter instance for an Address and create an InputFactory instance.
            $InputFilter = new InputFilter();
            $Factory = new InputFactory();
			
            // Create the necessary input validators.
			$Email = (new User())->getInputFilter()->get('email');
			
			// Submit button.
            $SubmitRestorePasswordForm = 
            [
                'name' => 'submitRestorePasswordForm',
                'required' => true,
            ];
            
            // Assemble the input filter and return it.
            $InputFilter->add($Email);
            $InputFilter->add($Factory->createInput($SubmitRestorePasswordForm));
            return $InputFilter;
        }
		
        /** Checks whether the given email address exists in the database. */
        public function isValid()
        {
            // Fetch the email from the input.
            $Email = $this->get('email')->getValue();
            
            // Check whether such email exists in the database.
            $Result = $this->getUserTable()->select(['Email' => $Email]);
            $EmailExists = $Result->count() == 1;
			
            // If the email isn't associated with any user, add appropriate message and return false.
            if($EmailExists == false)
            {
                $Messages['email']['NotExists'] = 'This email address is not associated with any user.';
                $this->setMessages($Messages);
            }
			else // Otherwise, reset the form and return true.
			{
				$this->resetData();
				return true;				
			}
        }
	}
?>