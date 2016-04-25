<?php

namespace DmnFea\Factory\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DmnFea\Controller\DmnFeaController;

class DmnfeaControllerServiceFactory implements FactoryInterface {

	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$dbFea = $serviceLocator->getServiceLocator()->get('dmn_fea');
		
		$controller = new DmnFeaController($dbFea);
		 
		return $controller;
	}

}

?>