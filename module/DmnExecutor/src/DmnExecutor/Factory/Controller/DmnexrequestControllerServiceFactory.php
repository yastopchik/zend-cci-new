<?php
namespace DmnExecutor\Factory\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DmnExecutor\Controller\DmnExrequestController;

class DmnexrequestControllerServiceFactory implements FactoryInterface 
{

	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$dbRequest = $serviceLocator->getServiceLocator()->get('dmn_exrequest');
		
		$controller = new DmnExrequestController($dbRequest);
		 
		return $controller;
	}

}

?>