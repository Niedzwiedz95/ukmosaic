<?php
	namespace User\Form;
	
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    
	use User\Model\Address;
	
    use User\Form\AddressForm;
	
	class AddAddressForm extends AddressForm
	{		
		/**	Constructor, sets attributes and adds the submit element. */
	    public function __construct()
	    {
	        // Set all attributes of the form.
	        parent::__construct('AddAddressForm');
            $this->setAttribute('action', '/user/addaddress');
            $this->setAttribute('id', 'addAddressForm');
			
	        // Submit button.
			$this->add(
			[
	            'name' => 'submitAddAddressForm',
	            'attributes' =>
	            [
	                'type'  => 'submit',
	                'id' => 'submitAddAddressForm',
                    'required' => 'required',
                    'value' => 'Add new adress',
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
                'name' => 'submitAddAddressForm',
                'required' => true,
            ];
            
            // Add the inputs to the input filter and return it.
            $InputFilter->add($Factory->createInput($SubmitAddAddres));
            return $InputFilter;
        }
    }