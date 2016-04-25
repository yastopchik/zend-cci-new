<?php

namespace DmnDatabase\Service;

use DmnDatabase\Service\AbstractServiceFactory;

class StatisticServiceFactory extends AbstractServiceFactory {

	protected function create() { 
        $service = new StatisticService($this->getServiceLocator()->get('DmnDatabase\Data\StatisticMapper'));
		return $service;
	}

}

?>