<?php
    namespace Core\Form;
    
    use Zend\Form\Form;
    use Zend\View\Model\ViewModel;
    use Zend\Db\Adapter\Adapter;
    use Zend\InputFilter\InputFilter;
    
    /** This class is the parent of all forms in the whole site. */
    abstract class BaseForm extends Form
    {
        // Stores the name of the form. Used to retrieve the correct template.
        protected $FormName;
        
        // Stores the DB instance used to perform queries.
        //protected $DB;
        
        /** Constructor, calls parent constructor and builds up the whole form */
        public function __construct($FormName)
        {
        	// Call parent constructor and set the form's name and attributes.
            parent::__construct($FormName);
            $this->FormName = $FormName;
            $this->setAttribute('method', 'post');
			
			// Sets the InputFilter. If the child forms don't override this method, it's empty.
            $this->setInputFilter($this->getInputFilter());
			
			// Add the CSRF element used for form security (I don't really remember what it does).
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
            return new InputFilter();
        }
        /** Returns the ViewModel template associated with this form. */
        public function getViewModel()
        {
            $Form = new ViewModel();
            $Form->setTemplate("Forms/$this->FormName.phtml");
            return $Form;
        }
        /** Sets the Adapter instance so the form can perform vlidating queries. */
        /*public function setDB(Adapter $DB)
        {
            $this->DB = $DB;
        }*/
        /** Returns the Adapter instance. */
        /*public function getDB()
        {
            return $this->DB;
        }*/
		
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
		
		/** This method makes us no longer need to declare getters or setters. */
        public function __call($Name, $Args)
        {
            // Get the property name.
            $Property = substr($Name, 3, 100);
            
            // Check if such poperty exists and determine if the first three letters are 'set' or 'get'.
            // If neither is the case, throw an exception.
            if(property_exists($this, $Property) && substr($Name, 0, 3) == 'get')
            {
                return $this->$Property;
            }
            else if(property_exists($this, $Property) && substr($Name, 0, 3) == 'set')
            {
                $this->$Property = $Args[0];
            }
            else
            {
                $Class = get_class($this);
                throw new \Exception("$Class has no $Property property!");
            }
        }
    }
?>