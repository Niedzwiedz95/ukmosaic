<?php
	namespace Core\Model;
	
	use Zend\InputFilter\Factory as InputFactory;
	use Zend\InputFilter\InputFilter;
	use Zend\InputFilter\InputFilterAwareInterface;
	use Zend\InputFilter\InputFilterInterface;
    use Zend\Validator;
	use Zend\Db\Adapter\Adapter;
	
	/**	This is a base class for all models. It provides exchangeArray for using with DB, conversion to array and automatic
	 * 	get/set. */
    class BaseModel implements InputFilterAwareInterface
    {        
		/**	Construct the base model. */
        public function __construct(array $Data = [])
        {
        	$this->exchangeArray($Data);
        }
		/**	Set the attributes to values provided in the $Data array. If $Data contains properties that do not
         *  belong to the class, they get discarded. */
	    public function exchangeArray(array $Data)
	    {
	        foreach(get_object_vars($this) as $Property => $Value)
            {
                $this->$Property = isset($Data[$Property]) ? $Data[$Property] : null;
            }
	    }
        /** Convert the model to an array. If some attribute is null, it isn't included in that array. */
        public function toArray()
        {
            // Create an empty array.
            $Array = [];
            
            // Iterate over the model's attributes.
            foreach(get_object_vars($this) as $Key => $Value)
            {
                // If the value isn't null, use getter method to get it's value.
                if($Value != null)
                {
                    // Create the getter's name.
                    $Getter = "get$Key";
                    
                    // Insert the value into the array.
                    $Array[$Key] = $this->$Getter();   
                }     
            }
            
            // Return the array.
            return $Array;
        }
		
        /** This method makes us no longer need to declare getters. */
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
        /** Required by InputFilterAwareInterface. */
        public function setInputFilter(InputFilterInterface $InputFilter)
        {
            throw new \Exception("BaseModel::setInputFilter shouldn't be used!");
        }
        /** This should return the InputFilter used to validate the model's properties - it should be overwritten
         *  in derived classes. */
        public function getInputFilter()
        {
            return false;
        }
    }
?>