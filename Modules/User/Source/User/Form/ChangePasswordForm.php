<?php
    namespace User\Form;
    
    use Zend\InputFilter\Factory as InputFactory;
    use Zend\InputFilter\InputFilter;
    
    use Core\Form\BaseForm;
    
    /** This class represents the form used to manage user's credentials. */
    class ChangePasswordForm extends BaseForm
    {
        /** Constructs the form. */
        public function __construct()
        {
            // Set all the necessary attributes.
            parent::__construct('ChangePasswordForm');
            $this->setAttribute('action', '/user/account');
            $this->setAttribute('id', 'changePasswordForm');
			$this->setAttribute('header', 'Change password');
            
            // Add the necessary elements.
            $this->add(
            [
                'name' => 'newPassword',
                'attributes' =>
                [
                   'type'  => 'password',
                   'id' => 'newPassword',
                   'placeholder' => 'New password',
                   'required' => 'required',
                ],
                'options' => ['label' => 'New password'],
            ]);
            $this->add(
            [
                'name' => 'reNewPassword',
                'attributes' =>
                [
                   'type'  => 'password',
                   'id' => 'reNewPassword',
                   'placeholder' => 'Confirm new password',
                   'required' => 'required',
                ],
                'options' => ['label' => 'Confirm new password'],
            ]);
            $this->add(
            [
                'name' => 'currentPassword',
                'attributes' =>
                [
                   'type'  => 'password',
                   'id' => 'currentPassword',
                   'placeholder' => 'Current password',
                   'required' => 'required',
                ],
                'options' => ['label' => 'Current password'],
            ]);
            $this->add(
            [
                'name' => 'submitChangePasswordForm',
                'attributes' =>
                [
                    'type'  => 'submit',
                    'id' => 'submitChangePasswordForm',
                    'required' => 'required',                    
                    'value' => 'Change',
                ]
            ]);
        }
        /** Returns the input filter appropriate for the current form. */
        public function getInputFilter()
        {
            // Create InputsFilter and InputFactory instances.
            $InputFilter = new InputFilter();
            $Factory = new InputFactory();
            
            // Input specifications.
            $NewPassword =
            [
                'name' => 'newPassword',
                'required' => true,
                'filters'  =>
                [
                    ['name' => 'StripTags'],
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
                    ],
                    [
                        'name' => 'regex',
                        'options' =>
                        [
                            'break_chain_on_failure' => true,
                            'pattern' => '/^[\p{Latin}0-9!@#$%^&*()_+-=,.;: ]{6,32}$/',
                            'messages' =>
                            [
                                'regexNotMatch' => 'Password can contain only letters, numbers, spaces and !@#$%^&*()_+-=,.;:'
                            ]
                        ]
                    ],
                    [
                        'name' => 'StringLength',
                        'options' =>
                        [
                            'break_chain_on_failure' => true,
                            'encoding' => 'UTF-8',
                            'min' => 6,
                            'max' => 32,
                            'messages' =>
                            [
                                'stringLengthTooShort' => 'Password must be 6 to 32 characters long.',
                                'stringLengthTooLong' => 'Password must be 6 to 32 characters long.',
                            ]
                        ]
                    ]
                ],
            ];
            $ReNewPassword =
            [
                'name' => 'reNewPassword',
                'required' => true,
                'filters'  =>
                [
                    ['name' => 'StripTags'],
                ],
                'validators' =>
                [
                    [
                        'name' => 'NotEmpty',
                        'options' =>
                        [
                            //'break_chain_on_failure' => true,
                            'messages' =>
                            [
                                'isEmpty' => 'Please confirm the new password!'
                            ]
                        ]
                    ],
                    [
                        'name' => 'identical',
                        'options' =>
                        [
                            'token' => 'newPassword',
                            'break_chain_on_failure' => true,
                            'messages' =>
                            [
                                'notSame' => 'Passwords do not match!'
                            ]
                        ]
                    ]
                ]
            ];
            $CurrentPassword = 
            [
                'name' => 'currentPassword',
                'required' => true,
                'filters'  =>
                [
                    ['name' => 'StripTags'],
                ],
                'validators' =>
                [
                    [
                        'name' => 'NotEmpty',
                        'options' =>
                        [
                            //'break_chain_on_failure' => true,
                            'messages' =>
                            [
                                'isEmpty' => 'Please enter the current password to verify your identity.'
                            ]
                        ]
                    ],
                ]
            ];
            $SubmitChangePasswordForm = 
            [
                'name' => 'submitChangePasswordForm',
                'required' => true,
            ];
            
            // Assemble the input filter and return it.
            $InputFilter->add($Factory->createInput($NewPassword));
            $InputFilter->add($Factory->createInput($ReNewPassword));
            $InputFilter->add($Factory->createInput($CurrentPassword));
            $InputFilter->add($Factory->createInput($SubmitChangePasswordForm));
            return $InputFilter;
        }
    }