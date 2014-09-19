<?php
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
		
		/** Returns the config of all the view helpers used in the Core module. */
        public function getViewHelperConfig() 
        {
            return
            [
                'invokables' =>
                [
                    'BootstrapForm' => 'Core\Form\View\Helper\BootstrapForm',
                    'RenderAddToCartForm' => 'Core\Form\View\Helper\RenderAddToCartForm',
                    'renderProductForm' => 'Core\Form\View\Helper\ProductFormRenderer'
                ],
            ];
        }
    }
?>