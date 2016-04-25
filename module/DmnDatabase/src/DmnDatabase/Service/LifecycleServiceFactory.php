<?php

namespace DmnDatabase\Service;

use DmnDatabase\Service\AbstractServiceFactory;

class LifecycleServiceFactory extends AbstractServiceFactory {

	protected function create() { 
        $service = new LifecycleService($this->getServiceLocator()->get('DmnDatabase\Data\LifecycleMapper'));
		return $service;
	}

}

?>