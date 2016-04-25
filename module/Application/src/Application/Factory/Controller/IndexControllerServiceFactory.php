<?php

namespace Application\Factory\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Controller\IndexController;

class IndexControllerServiceFactory implements FactoryInterface {

	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$contentService = $serviceLocator->getServiceLocator()->get('dmn_content');
		
		$controller = new IndexController($contentService);
		 
		return $controller;
	}

}

?>