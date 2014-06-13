<?php
    /* This namespace contains all forms used in the Mosaic module. */
    namespace Mosaic\Form;
    
    use Zend\Form\Form;
    use Zend\Validator;
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    use Zend\Validator\File;

    use Core\Form\BaseForm;
    
    
    /** This class represents the form used to contact Martin. */
    class ContactForm extends BaseForm
    {
        /** Construct the form. */
        public function __construct()
        {
            /* Set all the necessary attributes. */
            parent::__construct('ContactForm');
            $this->setAttribute('id', 'contactForm');
            $this->setAttribute('action', '/post');
            
            /* Create the necessary elements. */
            $this->add(
            [
                'name' => 'name',
                'attributes' =>
                [
                   'type'  => 'text',
                   'id' => 'name',
                   'placeholder' => 'Name',
                   'required' => 'required',
                ],
                'options' => ['label' => 'Name']
            ]);
            $this->add(
            [
                'name' => 'email',
                'attributes' =>
                [
                   'type'  => 'email',
                   'id' => 'email',
                   'placeholder' => 'Email',
                   'required' => 'required',
                ],
                'options' => ['label' => 'Email']
            ]);
            $this->add(
            [
                'name' => 'phoneNumber',
                'attributes' =>
                [
                   'type'  => 'text',
                   'id' => 'phoneNumber',
                   'placeholder' => 'Phone number',
                   'required' => 'required',
                ],
                'options' => ['label' => 'Phone Number']
            ]);
            $this->add(
            [
                'name' => 'comments',
                'attributes' =>
                [
                   'type'  => 'textarea',
                   'id' => 'comments',
                   'placeholder' => 'Your message here.',
                   'required' => 'required'
                ],
                'options' => ['label' => 'Comments']
            ]);
            $this->add(
            [
                'name' => 'SubmitContactForm',
                'attributes' =>
                [
                    'type'  => 'submit',
                    'id' => 'submitContactForm',
                    'required' => 'required',
                    'value' => 'Send',
                ]
            ]);
        }
        /** Returns the input filter appropriate for the current form. */
        public function getInputFilter()
        {
            return null;
        }
    }
?>