<?php
    /* This namespace contains all classes used by the Mosaic module. */
    namespace Mosaic;
    
    use Zend\Mvc\ModuleRouteListener;
    use Zend\Mvc\MvcEvent;

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
    }
?>