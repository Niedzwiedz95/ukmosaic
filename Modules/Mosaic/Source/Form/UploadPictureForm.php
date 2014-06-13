<?php
    /* This namespace contains all forms used in the Content module. */
    namespace Content\Form;
    
    use Zend\Form\Form;
    use Zend\Validator;
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    use Zend\Validator\File;

    use Core\Form\BaseForm;
    
    use Content\Model\Picture;
    
    /** This class represents the form used to upload pictures. */
    class UploadPictureForm extends BaseForm
    {
        /** Construct the form. */
        public function __construct()
        {
            /* Set all the necessary attributes. */
            parent::__construct('UploadPictureForm');
            $this->setAttribute('id', 'uploadPictureForm');
            $this->setAttribute('action', '/post');
            $this->setAttribute('enctype', 'multipart/form-data');
            
            /* Create the necessary elements. */
            $this->add(
            [
                'name' => 'Title',
                'attributes' =>
                [
                   'type'  => 'text',
                   'id' => 'title',
                   'placeholder' => 'Title',
                   'required' => 'required',
                ],
                'options' => ['label' => 'Title']
            ]);
            $this->add(
            [
                'name' => 'Language',
                'attributes' =>
                [
                   'type'  => 'select',
                   'id' => 'language',
                   'required' => 'required',
                   'Options' => ['en', 'pl', 'es', 'fr', 'de', 'it']
                ],
                'options' => ['label' => 'Language']
            ]);
            $this->add(
            [
                'name' => 'Repost',
                'attributes' =>
                [
                   'type'  => 'select',
                   'id' => 'repost',
                   'required' => 'required',
                   'Options' => ['yes', 'no']
                ],
                'options' => ['label' => 'Repost?']
            ]);
            $this->add(
            [
                'name' => 'Picture',
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
                'name' => 'SubmitUploadPictureForm',
                'attributes' =>
                [
                    'type'  => 'submit',
                    'id' => 'submitUploadPictureForm',
                    'required' => 'required',
                    'value' => 'Post!',
                ]
            ]);
        }
        /** Returns the input filter appropriate for the current form. */
        public function getInputFilter()
        {
            /* Create a Picture instance and get it's InputFilter. */
            $Picture = new Picture();
            $InputFilter = $Picture->getInputFilter();
            
            /* Create a InputFactory instance. */
            $Factory = new InputFactory();
            
            /* Create rest of the input specifications. */
            $Submit =
            [
                'name' => 'SubmitUploadPictureForm',
                'required' => true, 
            ];
            
            /* Assemble the input filter. */
            $InputFilter->add($Factory->createInput($Submit));
            
            /* Return the InputFilter instance. */
            return $InputFilter;
        }
        /** Check if the form is valid, including validating the file upload. */
        public function isReallyValid($PictureName)
        {
            /* If the form is invalid, return false. Otherwise proceed to validation of the file upload. */
            if(parent::isValid() == false)
            {
                return false;
            }
            
            /* Create instances of required validators. */
            $IsImage = new File\IsImage();
            $Extension = new File\Extension(["extension" => ['jpg', 'png', 'gif', 'jpeg']]);
            $Size = new File\ImageSize(['minWidth' => 250, 'minHeight' => 150]);
            
            /* Creates new adapter to send the file through http and sets the validator to $Size. */
            $FileTransfer = new \Zend\File\Transfer\Adapter\Http();
            $FileTransfer->setValidators([$IsImage, $Extension, $Size], $PictureName);

            /* If the file transfer is valid, return the $FileTransfer instance. Otherwise set all file transfer
             * errors in the form and return false. */
            if($FileTransfer->isValid())
            {
                return $FileTransfer;
            }            
            else
            {
                /* Get the errors from the filte transfer instance and create new array to hold the results. */
                $ErrorData = $FileTransfer->getMessages();
                $Errors = [];
                
                /* Add all messages (without the keys) to the array. */
                foreach($ErrorData as $Key => $Row)
                {
                    $Errors[] = $Row;
                }
                
                /* Set all the messages at once to Picture and return false. */
                $this->setMessages(['Picture' => $Errors]);
                return false;
            }
        }
    }
?>