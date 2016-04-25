<?php

namespace DmnLog\Service;

use DmnDatabase\Service\AbstractServiceFactory;
use Zend\Log\Logger;

class LogServiceFactory extends AbstractServiceFactory {

	protected function create() { 
		$config = $this->getServiceLocator()->get('config');
        $service = new LogService($config['directory']['log']);
        $service->setLogger(new Logger());        
		return $service;
	}

}

?>