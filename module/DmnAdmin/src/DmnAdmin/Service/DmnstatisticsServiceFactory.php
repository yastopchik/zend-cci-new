<?php

namespace DmnAdmin\Service;

use DmnDatabase\Service\AbstractServiceFactory;

class DmnstatisticsServiceFactory extends AbstractServiceFactory {

	protected function create() { 
        $statisticsService = new DmnstatisticsService();
        $statisticsService->setDbStatistic($this->getServiceLocator()->get('db_statistic')); 
        $statisticsService->setAuth($this->getServiceLocator()->get('zfcuser_user_service')->getUserAuthId());
        $statisticsService->setRole($this->getServiceLocator()->get('zfcuser_user_service')->getDefineRole());
		return $statisticsService;
	}

}

?>