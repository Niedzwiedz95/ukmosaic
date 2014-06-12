<?php
    /* This namespace contains all tests used by the User module. */
    namespace CoreTest;
    
    use Zend\Loader\AutoloaderFactory;
    use Zend\Mvc\Service\ServiceManagerConfig;
    use Zend\ServiceManager\ServiceManager;
    use Zend\Stdlib\ArrayUtils;
    use RuntimeException;
    
    error_reporting(E_ALL | E_STRICT);
    chdir(__DIR__);
    
    // This should be run only locally, so the Debug and Test globals are defined.
    define('Debug', true);
    define('Test', true);
    
    class Bootstrap
    {
        protected static $ServerManager;
        protected static $Config;
        protected static $Bootstrap;
    
        public static function init()
        {
            // Load the user-defined test configuration file, if it exists; otherwise, load
            if(is_readable(__DIR__ . "/TestConfig.php"))
            {
                $TestConfig = include __DIR__ . "/TestConfig.php";
            }
            else
            {
                $TestConfig = include __DIR__ . "/TestConfig.php.dist";
            }
    
            $zf2ModulePaths = [];
    
            if(isset($TestConfig["module_listener_options"]["module_paths"]))
            {
                $modulePaths = $TestConfig["module_listener_options"]["module_paths"];
                foreach ($modulePaths as $modulePath)
                {
                    if(($path = static::findParentPath($modulePath)))
                    {
                        $zf2ModulePaths[] = $path;
                    }
                }
            }
    
            $zf2ModulePaths  = implode(PATH_SEPARATOR, $zf2ModulePaths) . PATH_SEPARATOR;
            $zf2ModulePaths .= getenv("ZF2_MODULES_TEST_PATHS") ?: (defined("ZF2_MODULES_TEST_PATHS") ? ZF2_MODULES_TEST_PATHS : "");
    
            static::initAutoloader();
    
            // use ModuleManager to load this module and it"s dependencies
            $BaseConfig =
            [
                "module_listener_options" =>
                [
                    "module_paths" => explode(PATH_SEPARATOR, $zf2ModulePaths),
                ],
                'modules' =>
                [
                   'User'
                ]
            ];
    
            $Config = ArrayUtils::merge($BaseConfig, $TestConfig);
    
            $ServerManager = new ServiceManager(new ServiceManagerConfig());
            $ServerManager->setService("ApplicationConfig", $Config);
            $ServerManager->get("ModuleManager")->loadModules();
    
            static::$ServerManager = $ServerManager;
            static::$Config = $Config;
        }
    
        public static function getServiceManager()
        {
            return static::$ServerManager;
        }
    
        public static function getConfig()
        {
            return static::$Config;
        }
    
        protected static function initAutoloader()
        {
            $vendorPath = static::findParentPath("vendor");
    
            if(is_readable($vendorPath . "/autoload.php"))
            {
                $loader = include $vendorPath . "/autoload.php";
            }
            else
            {
                $zf2Path = getenv("ZF2_PATH") ?: (defined("ZF2_PATH") ? ZF2_PATH : (is_dir($vendorPath . "/ZF2/library") ? $vendorPath . "/ZF2/library" : false));
    
                if(!$zf2Path)
                {
                    throw new RuntimeException("Unable to load ZF2. Run `php composer.phar install` or define a ZF2_PATH environment variable.");
                }
    
                include $zf2Path . "/Zend/Loader/AutoloaderFactory.php";    
            }
    
            AutoloaderFactory::factory(
            [
                "Zend\Loader\StandardAutoloader" =>
                [
                    "autoregister_zf" =>
                    [
                        "namespaces" =>
                        [
                            __NAMESPACE__ => __DIR__ . "/" . __NAMESPACE__,
                        ]
                    ],
                ]
            ]);
        }
    
        protected static function findParentPath($path)
        {
            $dir = __DIR__;
            $previousDir = ".";
            while(!is_dir($dir . "/" . $path))
            {
                $dir = dirname($dir);
                if($previousDir === $dir)
                {
                    return false;
                }
                $previousDir = $dir;
            }
            return $dir . "/" . $path;
        }
    }
    
    Bootstrap::init();
?>