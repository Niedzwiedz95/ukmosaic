<?php
    /** This namespace contains all the code for the Core module. */
    namespace Core;
    
    use Zend\Mvc\ModuleRouteListener;
    use Zend\Mvc\MvcEvent;
    
    use Core\BaseModule;
   
    /** Class that manages the whole Core module. */
    class Module extends BaseModule
    {
        
    }
    
    /** Class that manages the whole Core module. */
    class BaseModule
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
                // Standard autoloader required by ZF2, don't remove it!
                'Zend\Loader\StandardAutoloader' =>
                [
                    'namespaces' =>
                    [
                        __NAMESPACE__ => __DIR__ . '/Source/' . __NAMESPACE__,
                    ],
                ],
            ];
        }
    }
?>