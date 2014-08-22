<?php
	namespace User\Form;
	
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    	
	use User\Model\Address;
	
    use User\Form\AddressForm;
    
	class EditAddressForm extends AddressForm
	{		
		/**	Constructor, sets attributes and adds the submit element. */
	    public function __construct($AddressID)
	    {
	        // Set all attributes of the form.
	        parent::__construct('EditAddressForm');
            $this->setAttribute('action', '/user/editaddress/' . $AddressID);
            $this->setAttribute('id', 'editAddressForm');
			$this->setAttribute('header', 'Edit address');
			
	        // Submit button.
			$this->add(
			[
	            'name' => 'submitEditAddressForm',
	            'attributes' =>
	            [
	                'type'  => 'submit',
	                'id' => 'submitEditAddressForm',
                    'required' => 'required',
                    'value' => 'Save',
	        	]
	        ]);
	    }

		/** Return the input filter appropriate for the current form. */
        public function getInputFilter()
        {
            // Get an InputFilter instance for an Address and create an InputFactory instance.
            $InputFilter = (new Address())->getInputFilter();
            $Factory = new InputFactory();
						
			// Submit button.
            $SubmitAddAddres = 
            [
                'name' => 'submitEditAddressForm',
                'required' => true,
            ];
            
            // Add the inputs to the input filter and return it.
            $InputFilter->add($Factory->createInput($SubmitAddAddres));
            return $InputFilter;
        }
    }