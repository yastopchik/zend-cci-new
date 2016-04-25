<?php

namespace DmnDatabase\Service;

use DmnDatabase\Service\AbstractServiceFactory;

class StatusServiceFactory extends AbstractServiceFactory {

	protected function create() { 
        $service = new StatusService($this->getServiceLocator()->get('DmnDatabase\Data\StatusMapper'));
		return $service;
	}

}

?>