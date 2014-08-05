<?php
	namespace User\Model;
    
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Adapter\Adapter;
	use Zend\Db\TableGateway\TableGateway;
	
    use Core\Model\BaseTable;
	
	use User\Model\Address;
    
	/**	TableGateway to the Addresses table. */
	class AddressTable extends BaseTable
	{
		
		/** Insert a new address into the database and return its id. */
        public function insertAddress(Address $Address)
        {
            // Insert the address into the database and check whether that was successful.
            if($this->insert($Address))
            {
            	// Return the id of the inserted address.
                return $this->getTableGateway()->getLastInsertValue();
            }
            else
            {
                // Insertion failed. Throw an exception. 
                throw new \Exception("Couldn't insert new address into the database!");
            }
        }
	}
?>