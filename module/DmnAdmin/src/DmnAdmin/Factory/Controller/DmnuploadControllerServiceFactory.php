<?php

namespace DmnAdmin\Factory\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DmnAdmin\Controller\DmnUploadController;

class DmnuploadControllerServiceFactory implements FactoryInterface {

	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$upload = $serviceLocator->getServiceLocator()->get('dmn_upload');
		
		$controller = new DmnUploadController($upload);
		 
		return $controller;
	}

}

?>