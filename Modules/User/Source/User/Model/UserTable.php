<?php
	namespace User\Model;
    
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Adapter\Adapter;
	use Zend\Db\TableGateway\TableGateway;
	
    use Core\Model\BaseTable;
	
	use User\Model\User;
    
	/**	TableGateway to the Users table. */
	class UserTable extends BaseTable
	{
		/** Insert a new user into the database and return his id. */
        public function insertUser(User $User)
        {
            // Insert the user into the database and check whether that was successful.
            if($this->insert($User))
            {
            	// Return the id of the inserted user.
                return $this->getTableGateway()->getLastInsertValue(); 
            }
            else
            {
                // Insertion failed. Throw an exception. 
                throw new \Exception("Couldn't insert new user into the database!");
            }
        }
		
		/** Inserts a link between User and Address to the UsersAddresses database. */
		public function insertLink($UserID, $AddressID)
		{
			$Query = "INSERT INTO UsersAddresses (UserID, AddressID) VALUES (?, ?)";
			$Values = [$UserID, $AddressID];
			
			$this->getDB()->query($Query, $Values);
		}
	}
?>