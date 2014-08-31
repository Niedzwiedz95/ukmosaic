<?php
    /* This namespace contains all classes used by the Mosaic module. */
    namespace Mosaic;
    
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
        /** Called when the module is bootstrapped. Sets all the necessary things up. */
        public function onBootstrap(MvcEvent $Event)
        {
            
        }
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
                    /*'Mosaic\Model\AddressTable' => function($ServiceManager)
                    {
                    	// Get a database adapter instance.
                    	$DB = $ServiceManager->get('Zend\Db\Adapter\Adapter');
						
						// Make address the object prototype of the Addresses table.
                        $ResultSet = new ResultSet();
                        $ResultSet->setArrayObjectPrototype(new Address());
						
						// Create a gateway to the Addresses table.
                        $TableGateway = new TableGateway('Addresses', $DB, null, $ResultSet);
						
						// Return a new instance of the AddressesTable.
                        return new AddressesTable($TableGateway);
                    },*/
                    'Mosaic\Model\OrderTable' => function($ServiceManager)
                    {
                    	$DB = $ServiceManager->get('Zend\Db\Adapter\Adapter');
                        $ResultSet = new ResultSet();
                        $ResultSet->setArrayObjectPrototype(new Order());
                        $TableGateway = new TableGateway("Orders", $DB, null, $ResultSet);
                        return new \Mosaic\Model\OrderTable($TableGateway);
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
                    },
                    /*'Mosaic\Model\UsersTable' => function($ServiceManager)
                    {
                    	$DB = $ServiceManager->get('Zend\Db\Adapter\Adapter');
                        $ResultSet = new ResultSet();
                        $ResultSet->setArrayObjectPrototype(new User());
                        $TableGateway = new TableGateway('Users', $DB, null, $ResultSet);
                        return new UsersTable($TableGateway);
                    },*/
                    /*'Mosaic\Form\ContactForm' => function($ServiceManager)
                    {
                        $DB = $ServiceManager->get('Zend\Db\Adapter\Adapter');
                        $ContactForm = new ContactForm();
                        $ContactForm->setDB($DB);
                        return $ContactForm;
                    }*/
                ]
            ];
        }
    }
?>