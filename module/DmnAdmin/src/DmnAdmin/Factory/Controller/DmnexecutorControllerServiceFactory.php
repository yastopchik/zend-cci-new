<?php

namespace DmnAdmin\Factory\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DmnAdmin\Controller\DmnExecutorController;

class DmnexecutorControllerServiceFactory implements FactoryInterface {

	public function createService(ServiceLocatorInterface $serviceLocator)
	{				
		$dbExecutor=$serviceLocator->getServiceLocator()->get('dmn_executor');
		
		$controller = new DmnExecutorController($dbExecutor);
		 
		return $controller;
	}

}

?>