<?php

namespace DmnDatabase\Service;

use DmnDatabase\Service\AbstractServiceFactory;

class CountryServiceFactory extends AbstractServiceFactory {

	protected function create() { 
        $service = new CountryService($this->getServiceLocator()->get('DmnDatabase\Data\CountryMapper'));
		return $service;
	}

}

?>