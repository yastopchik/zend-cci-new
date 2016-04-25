<?php

namespace DmnDatabase\Service;

use DmnDatabase\Service\AbstractServiceFactory;

class PriorityServiceFactory extends AbstractServiceFactory {

	protected function create() { 
        $service = new PriorityService($this->getServiceLocator()->get('DmnDatabase\Data\PriorityMapper'));
		return $service;
	}

}

?>