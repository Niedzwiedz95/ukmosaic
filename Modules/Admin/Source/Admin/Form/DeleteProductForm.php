<?php
	namespace Admin\Form;
	
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    
    use Core\Form\BaseForm;
    
	class DeleteProductForm extends BaseForm
	{		
		/**	Constructor, sets attributes and adds the submit element. */
	    public function __construct($FormName)
	    {
	    	// Call parent's constructor with the form name so nothing breaks down.
	    	parent::__construct($FormName);
			
            // ProductID.
			$this->add(
			[
	            'name' => 'productId',
	            'attributes' =>
	            [
	                'type'  => 'text',
	                'id' => 'productId',
                    'required' => 'required',
	        	],
	            'options' => ['label' => 'ProductID']
	        ]);
			
			// Submit button.
			$this->add(
			[
	            'name' => 'submitDeleteProductForm',
	            'attributes' =>
	            [
	                'type'  => 'submit',
	                'id' => 'submitDeleteProductForm',
                    'required' => 'required',
                    'value' => 'Delete',
	        	]
	        ]);
	    }
    }