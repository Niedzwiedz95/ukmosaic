<?php
    namespace Shop;
    
    use Zend\Mvc\ModuleRouteListener;
    use Zend\Mvc\MvcEvent;
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\TableGateway\TableGateway;
	
	use Mosaic\Model\Address;
	use Mosaic\Model\Order;
	use Mosaic\Model\Product;
	use Mosaic\Model\User;
	
	use Mosaic\Model\AddressesTable;
	use Mosaic\Model\ProductTable;
	use Mosaic\Model\UsersTable;
	
	use Mosaic\Form\ContactForm;

    /** Class that manages the whole Mosaic module. */
    class Module
    {
        /** Includes the module's main config file. */
        public function getConfig()
        {
            return include __DIR__ . '/Config/ModuleConfig.php';
        }
        /** Returns the config of the autoloader. */
        public function getAutoloaderConfig()
        {
            return
            [
                'Zend\Loader\StandardAutoloader' =>
                [
                    'namespaces' =>
                    [
                        __NAMESPACE__ => __DIR__ . '/Source/' . __NAMESPACE__,
                    ]
                ]
            ];
        }
		
        /** Returns the config of the services used in the module. */
        public function getServiceConfig()
        {
            return
            [
                'factories' =>
                [
                    /*'Mosaic\Model\OrderTable' => function($ServiceManager)
                    {
                    	$DB = $ServiceManager->get('Zend\Db\Adapter\Adapter');
                        $ResultSet = new ResultSet();
                        $ResultSet->setArrayObjectPrototype(new Order());
                        $TableGateway = new TableGateway("Orders", $DB, null, $ResultSet);
						
						// Inject an OrderProductTable instance to the OrderTable instance.
						$OrderTable = new \Mosaic\Model\OrderTable($TableGateway);
						$OrderTable->setOrderProductTable($ServiceManager->get('Mosaic\Model\OrderProductTable'));
						
						// Return the OrderTable.
                        return $OrderTable;
                    },
                    'Mosaic\Model\ProductTable' => function($ServiceManager)
                    {
                    	$DB = $ServiceManager->get('Zend\Db\Adapter\Adapter');
                        $ResultSet = new ResultSet();
                        $ResultSet->setArrayObjectPrototype(new Product());
                        $TableGateway = new TableGateway('Products', $DB, null, $ResultSet);
                        return new ProductTable($TableGateway);
                    },
                    'Mosaic\Model\OrderProductTable' => function($ServiceManager)
                    {
                    	$DB = $ServiceManager->get('Zend\Db\Adapter\Adapter');
                        $ResultSet = new ResultSet();
                        $ResultSet->setArrayObjectPrototype(new \Mosaic\Model\OrderProduct());
                        $TableGateway = new TableGateway('OrderProducts', $DB, null, $ResultSet);
                        return new ProductTable($TableGateway);
                    },*/
                ]
            ];
        }
    }
?>