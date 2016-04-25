<?php

namespace DmnAdmin\Factory\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DmnAdmin\Controller\DmnStatisticsController;

class DmnstatisticsControllerServiceFactory implements FactoryInterface {

	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$statisticsService = $serviceLocator->getServiceLocator()->get('dmn_statistics');
		
		$controller = new DmnStatisticsController($statisticsService);
		 
		return $controller;
	}

}

?>