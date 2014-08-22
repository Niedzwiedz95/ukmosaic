<?php
    namespace Mosaic\Form;
    
    use Zend\Form\Form;
    use Zend\Validator;
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    use Zend\Validator\File;

    use Core\Form\BaseForm;
    
    class ContactForm extends BaseForm
    {
        /** Construct the form. */
        public function __construct()
        {
            // Set all the necessary attributes.
            parent::__construct('ContactForm');
            $this->setAttribute('id', 'contactForm');
            $this->setAttribute('action', '/contact');
			$this->setAttribute('header', 'Contact us');
            
            // Create the necessary elements.
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
                   'required' => '',
                ],
                'options' => ['label' => 'Phone number']
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
                'name' => 'submitContactForm',
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
            // Create new InputFilter instance.
            $InputFilter = new InputFilter();
            
            // Create a factory instance used to add more validators to the filter.
            $Factory = new InputFactory();
			
			// Add the necessary validators.
            $Name =
            [
                'name' => 'name',
                'required' => true,
                'filters'  =>
                [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators' =>
                [
                    [
                        'name' => 'NotEmpty',
                        'options' =>
                        [
                            'messages' =>
                            [
                                'isEmpty' => 'This field is required.'
                            ]
                        ]
                    ]
                ]
            ];
            $Email =
            [
                'name' => 'email',
                'required' => true,
                'validators' =>
                [
                    [
                        'name' => 'NotEmpty',
                        'options' =>
                        [
                            'messages' =>
                            [
                                'isEmpty' => 'This field is required.'
                            ]
                        ]
                    ],
                    [
                        'name' => 'EmailAddress',
                        'options' =>
                        [
                            'encoding' => 'UTF-8',
                            'max' => 255,
                            'break_chain_on_failure' => true,
                            'messages' =>
                            [
                                'emailAddressInvalidFormat' => 'Invalid email address format.',
                                'emailAddressInvalidHostname' => 'Invalid email address format.',
                                'hostnameInvalidHostname' => 'Invalid email address format.',
                                'hostnameLocalNameNotAllowed' => 'Invalid email address format.',
                            ]
                        ]
                    ]
                ],
            ];
            $PhoneNumber =
            [
                'name' => 'phoneNumber',
                'required' => false,
                'filters'  =>
                [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators' =>
                [
                    [
                        'name' => 'regex',
                        'options' =>
                        [
                            'break_chain_on_failure' => true,
                            'pattern' => '/^[0-9]*$/u',
                            'messages' =>
                            [
                                'regexNotMatch' => 'Phone number can only contain digits!'
                            ]
                        ]
                    ]
                ]
            ];
            $Comments =
            [
                'name' => 'comments',
                'required' => true,
                'filters'  =>
                [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators' =>
                [
                    [
                        'name' => 'NotEmpty',
                        'options' =>
                        [
                            'messages' =>
                            [
                                'isEmpty' => 'This field is required.'
                            ]
                        ]
                    ]
                ]
            ];
			
            // Add the validators to the input filter and return it.
            $InputFilter->add($Factory->createInput($Name));
            $InputFilter->add($Factory->createInput($Email));
            $InputFilter->add($Factory->createInput($PhoneNumber));
            $InputFilter->add($Factory->createInput($Comments));
            return $InputFilter;
        }
    }
?>