<?php

namespace DmnDatabase\Service;

use DmnDatabase\Service\AbstractServiceFactory;

class RequestServiceFactory extends AbstractServiceFactory {

	protected function create() { 
        $service = new RequestService($this->getServiceLocator()->get('DmnDatabase\Data\RequestMapper'));
		return $service;
	}

}

?>