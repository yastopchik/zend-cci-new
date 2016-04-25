<?php

namespace DmnAdmin\Factory\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DmnAdmin\Controller\DmnContentController;

class DmncontentControllerServiceFactory implements FactoryInterface {

	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$dbContent = $serviceLocator->getServiceLocator()->get('dmn_content');
		
		$controller = new DmnContentController($dbContent);
		 
		return $controller;
	}

}

?>