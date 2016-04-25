<?php

namespace DmnAdmin\Factory\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DmnAdmin\Controller\DmnRequestController;

class DmnrequestControllerServiceFactory implements FactoryInterface {

	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$dbRequest = $serviceLocator->getServiceLocator()->get('dmn_request');
		
		$controller = new DmnRequestController($dbRequest);
		 
		return $controller;
	}

}

?>