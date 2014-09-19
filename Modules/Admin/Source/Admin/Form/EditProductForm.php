<?php
	namespace Admin\Form;
	
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    
    use Admin\Form\ProductForm;
    
	class EditProductForm extends ProductForm
	{		
		/**	Constructor, sets attributes and adds the submit element. */
	    public function __construct()
	    {
	        // Set all attributes of the form.
	        parent::__construct('EditProductForm');
            $this->setAttribute('action', '/admin/editproduct');
            $this->setAttribute('id', 'editProductForm');
			$this->setAttribute('header', 'Edit a product');
			
	        // Submit button.
			$this->add(
			[
	            'name' => 'submitEditProductForm',
	            'attributes' =>
	            [
	                'type'  => 'submit',
	                'id' => 'submitEditProductForm',
                    'required' => 'required',
                    'value' => 'Save',
	        	]
	        ]);
	    }
    }