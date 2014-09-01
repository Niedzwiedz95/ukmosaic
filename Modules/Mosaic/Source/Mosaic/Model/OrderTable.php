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
		// Properties.
		protected $OrderProductTable;
		
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
		
		/** Select an order from the database with all its OrderProducts. */
		public function selectOrder($OrderID)
		{
			// Fetch the order from the database.
			$Order = $this->select(['OrderID' => $OrderID])->buffer()->current();
			
			// Fetch the OrderProducts from the database.
			$OrderProducts = $this->getOrderProductTable()->select(['OrderID' => $OrderID])->buffer();
			
			// Set the order's OrderProducts and return the order.
			$Order->setOrderProducts($OrderProducts);
			return $Order;
		}
	}
?>