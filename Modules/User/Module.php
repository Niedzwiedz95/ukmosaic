<?php
    namespace User;
    
    use Zend\Mvc\MvcEvent;
    use Zend\Db\ResultSet\ResultSet;
    use Zend\Db\TableGateway\TableGateway;
    
	use Core\BaseModule;
	
    use User\Model\User;
    use User\Model\Address;
	
	use User\Model\UserTable;
	use User\Model\AddressTable;
    
    use User\Form\SignupForm;
    
    /** Class that manages the whole User module. */
    class Module extends BaseModule
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
                	// Tables
                    'User\Model\UserTable' => function($ServiceManager)
                    {
                    	$DB = $ServiceManager->get('Zend\Db\Adapter\Adapter');
                        $ResultSet = new ResultSet();
                        $ResultSet->setArrayObjectPrototype(new User());
                        $TableGateway = new TableGateway('Users', $DB, null, $ResultSet);
                        $UserTable = new UserTable($TableGateway);
                        return $UserTable;
                    },
                    'User\Model\AddressTable' => function($ServiceManager)
                    {
                    	$DB = $ServiceManager->get('Zend\Db\Adapter\Adapter');
                        $ResultSet = new ResultSet();
                        $ResultSet->setArrayObjectPrototype(new Address());
                        $TableGateway = new TableGateway('Addresses', $DB, null, $ResultSet);
                        $AddressTable = new AddressTable($TableGateway);
                        return $AddressTable;
                    },
                    // Forms
                    'User\Form\SignupForm' => function($ServiceManager)
                    {
                        $DB = $ServiceManager->get('Zend\Db\Adapter\Adapter');
                        $SignupForm = new SignupForm();
                        $SignupForm->setDB($DB);
                        return $SignupForm;
                    },
                ]
            ];
        }
    }
?>