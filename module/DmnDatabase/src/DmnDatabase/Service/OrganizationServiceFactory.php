<?php

namespace DmnDatabase\Service;

use DmnDatabase\Service\AbstractServiceFactory;

class OrganizationServiceFactory extends AbstractServiceFactory {

	protected function create() { 
        $service = new OrganizationService($this->getServiceLocator()->get('DmnDatabase\Data\OrganizationMapper'));
		return $service;
	}

}

?>