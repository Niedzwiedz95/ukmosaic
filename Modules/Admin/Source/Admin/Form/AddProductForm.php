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
			$this->setAttribute('enctype', 'multipart/form-data');
			
	        // Picture selection and a submit button.
            $this->add(
            [
                'name' => 'picture',
                'attributes' =>
                [
                   'type'  => 'file',
                   'id' => 'picture',
                   'required' => 'required'
                ],
                'options' => ['label' => 'Picture']
            ]);
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

        /** Check whether the form is valid, including validating the file upload. */
        public function isReallyValid($PictureName)
        {
            // If the form is invalid, return false. Otherwise proceed to validation of the file upload.
            if(parent::isValid() == false)
            {
                return false;
            }
            
            // Create instances of required validators.
            $IsImage = new \Zend\Validator\File\IsImage();
            $Extension = new \Zend\Validator\File\Extension(["extension" => ['jpg', 'png', 'jpeg']]);
            $Size = new \Zend\Validator\File\ImageSize(['minWidth' => 250, 'minHeight' => 150]);
            
            // Creates new adapter to send the file through http and sets the validator to $Size.
            $FileTransfer = new \Zend\File\Transfer\Adapter\Http();
            $FileTransfer->setValidators([$IsImage, $Extension, $Size], $PictureName);

            // If the file transfer is valid, return the $FileTransfer instance. Otherwise set all file transfer
            // errors in the form and return false.
            if($FileTransfer->isValid())
            {
                return $FileTransfer;
            }            
            else
            {
                // Get the errors from the file transfer instance and create a new array to hold the results.
                $ErrorData = $FileTransfer->getMessages();
                $Errors = [];
                
                // Add all messages (without the keys) to the array.
                foreach($ErrorData as $Key => $Row)
                {
                    $Errors[] = $Row;
                }
				
                // Set all the messages at once to Picture and return false.
                $this->setMessages(['Picture' => $Errors]);
                return false;
            }
        }
    }