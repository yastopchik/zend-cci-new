<?php
namespace DmnDatabase;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

class Module implements AutoloaderProviderInterface {
	
    
    public function getConfig()
    {
    	return include __DIR__ . '/config/module.config.php';
    }
    public function getAutoloaderConfig() {
		return [
			'Zend\Loader\ClassMapAutoloader' => [
				__DIR__ . DIRECTORY_SEPARATOR . 'autoload_classmap.php' 
			],
			'Zend\Loader\StandardAutoloader' => [
				'namespaces' => [
					__NAMESPACE__ => __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . str_replace('\\', '/', __NAMESPACE__) 
				] 
			] 
		];
	}

}