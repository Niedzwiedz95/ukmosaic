<?php
	namespace Mosaic\Model;
    
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\Adapter\Adapter;
	use Zend\Db\TableGateway\TableGateway;
	
    use Core\Model\BaseTable;
    use Mosaic\Model\Order;
	
	/**	TableGateway to the Orders table. */
	class OrderTable extends BaseTable
	{
		/** Inserts a new order into the database and return its id. */
        public function insertOrder(Order $Order)
        {
            // Insert the order into the database and check whether that was successful.
            if($this->insert($Order))
            {
            	// Return the id of the inserted order.
                return $this->getTableGateway()->getLastInsertValue();
            }
            else
            {
                // Insertion failed. Throw an exception. 
                throw new \Exception("Couldn't insert new order into the database!");
            }
        }
	}
?>