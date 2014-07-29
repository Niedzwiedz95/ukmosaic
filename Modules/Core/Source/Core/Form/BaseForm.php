<?php
    /* This namespace contains all forms used in the Core module. */
    namespace Core\Form;
    
    use Zend\Form\Form;
    use Zend\View\Model\ViewModel;
    use Zend\Db\Adapter\Adapter;
    
    /** This class is the parent of all forms in the whole site. */
    abstract class BaseForm extends Form
    {
        /** Stores the name of the form. Used to retrieve the correct template. */
        protected $FormName;
        
        /** Stores the DB instance used to perform queries. */
        protected $DB;
        
        /** Constructor, calls parent constructor and builds up the whole form */
        public function __construct($FormName)
        {
            parent::__construct($FormName);
            $this->FormName = $FormName;
            $this->setAttribute('method', 'post');
            $this->setInputFilter($this->getInputFilter());
            $this->add(
            [
                'name' => $FormName . 'CSRF',
                'type' => 'Zend\Form\Element\Csrf',
                'attributes' =>
                [
                    'id' => $FormName . 'CSRF',
                    'type' => 'hidden',
                    'required' => 'required'
                ],
                'options' =>
                [                    
                    'csrf_options' =>
                    [
                        'timeout' => 600
                    ],
                ]              
            ]);
        }
        /** Returns the input filter appropriate for the current form */
        public function getInputFilter()
        {
            return null;
        }
        /** Returns the ViewModel template associated with this form. */
        public function getViewModel()
        {
            $Form = new ViewModel();
            $Form->setTemplate("Forms/$this->FormName.phtml");
            return $Form;
        }
        /** Sets the Adapter instance so the form can perform vlidating queries. */
        public function setDB(Adapter $DB)
        {
            $this->DB = $DB;
        }
        /** Returns the Adapter instance. */
        public function getDB()
        {
            return $this->DB;
        }
		
		/** Resets the form's data. */
		public function resetData()
		{
			foreach($this->getElements() as $Element)
			{
				// This check is needed in order not to erase labels from submit buttons.
				if($Element->getAttribute('type') != 'submit')
				{
					$Element->setValue('');
				}
			}
		}
		
		/** Checks whether the form is valid and sets all the error messages. */
		public function isValid()
		{
			// If the form is valid according to the parent class, return true.
			if(parent::isValid())
			{
				// Reset the state of the form.
				$this->resetData();
				return true;
			}
			else // If the form is not valid, set the error messages and return false.
			{
				$this->setMessages($this->getMessages());
				return false;
			}
		}
    }
?>