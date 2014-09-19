<?php
	namespace Admin\Form;
	
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    
    use Admin\Form\ProductForm;
    
	class AddProductForm extends ProductForm
	{		
		/**	Constructor, sets attributes and adds the submit element. */
	    public function __construct()
	    {
	        // Set all attributes of the form.
	        parent::__construct('AddProductForm');
            $this->setAttribute('action', '/admin/addproduct');
            $this->setAttribute('id', 'addProductForm');
			$this->setAttribute('header', 'Add a new product');
			
	        // Submit button.
			$this->add(
			[
	            'name' => 'submitAddProductForm',
	            'attributes' =>
	            [
	                'type'  => 'submit',
	                'id' => 'submitAddProductForm',
                    'required' => 'required',
                    'value' => 'Add',
	        	]
	        ]);
	    }
    }