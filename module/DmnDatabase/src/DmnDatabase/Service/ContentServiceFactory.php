<?php

namespace DmnDatabase\Service;

use DmnDatabase\Service\AbstractServiceFactory;

class ContentServiceFactory extends AbstractServiceFactory {

	protected function create() { 
        $service = new ContentService($this->getServiceLocator()->get('DmnDatabase\Data\ContentMapper'));
		return $service;
	}

}

?>