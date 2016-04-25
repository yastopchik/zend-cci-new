<?php

namespace DmnAdmin\Factory\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DmnAdmin\Controller\DmnUserController;

class DmnuserControllerServiceFactory implements FactoryInterface {

	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$dbUser=$serviceLocator->getServiceLocator()->get('dmn_user');
		
		$controller = new DmnUserController($dbUser);
		 
		return $controller;
	}

}

?>