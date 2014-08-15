<?php
	namespace User\Form;
	
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    
    use Core\Form\BaseForm;
	
	use User\Model\Address;
    
	abstract class AddressForm extends BaseForm
	{		
		/**	Constructor, sets attributes and adds the submit element. */
	    public function __construct($FormName)
	    {
	    	// Call parent's constructor with the form name so nothing breaks down.
	    	parent::__construct($FormName);
			
            // Address elements.
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
	    }
    }