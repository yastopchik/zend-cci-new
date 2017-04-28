<?php

namespace Application\Factory\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Controller\RequestsController;

class RequestsControllerServiceFactory implements FactoryInterface {

	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$requestsService = $serviceLocator->getServiceLocator()->get('requests');
		
		$controller = new RequestsController($requestsService);
		 
		return $controller;
	}

}
