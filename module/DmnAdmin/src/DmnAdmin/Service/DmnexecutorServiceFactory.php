<?php

namespace DmnAdmin\Service;

use DmnDatabase\Service\AbstractServiceFactory;
use DmnAdmin\Options\GridOptions;

class DmnexecutorServiceFactory extends AbstractServiceFactory {

	protected function create() { 
        $executorService = new DmnexecutorService($this->getServiceLocator()->get('cache'));  
        $executorService->setDbUser($this->getServiceLocator()->get('db_user'));
        $executorService->setDbOrganization($this->getServiceLocator()->get('db_organization'));
        $executorService->setDbCountry($this->getServiceLocator()->get('db_country'));
        $executorService->setZfcUserOptions($this->getServiceLocator()->get('zfcuser_module_options'));
        $executorService->setOptions(new GridOptions());
        $executorService->setAuth($this->getServiceLocator()->get('zfcuser_user_service')->getUserAuthId());
        $logger=$this->getServiceLocator()->get('logger');
        $logger->openStream('user');
        $executorService->setLogger($logger);
               
		return $executorService;
	}

}

?>