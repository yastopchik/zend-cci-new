<?php

namespace DmnDatabase\Service;

use DmnDatabase\Service\AbstractServiceFactory;

class FormsServiceFactory extends AbstractServiceFactory {

	protected function create() { 
        $service = new FormsService($this->getServiceLocator()->get('DmnDatabase\Data\FormsMapper'));        
		return $service;
	}

}

?>