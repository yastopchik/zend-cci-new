<?php

namespace Application\Service;

use DmnDatabase\Service\AbstractServiceFactory;
use Application\Options\GridOptions;

class RequestsServiceFactory extends AbstractServiceFactory {

	protected function create() { 
        $requestService = new RequestsService($this->getServiceLocator()->get('cache'));
        $requestService->setDbRequest($this->getServiceLocator()->get('db_request'));
        $requestService->setUploadService($this->getServiceLocator()->get('dmn_upload'));
        $requestService->setDbPriority($this->getServiceLocator()->get('db_priority')); 
        $requestService->setDbStatus($this->getServiceLocator()->get('db_status'));
        $requestService->setDbLifecycle($this->getServiceLocator()->get('db_lifecycle'));
        $requestService->setDbUser($this->getServiceLocator()->get('db_user'));
        $requestService->setDbCountry($this->getServiceLocator()->get('db_country'));
        $requestService->setAuth($this->getServiceLocator()->get('zfcuser_user_service')->getUserAuthId());
        $requestService->setRole($this->getServiceLocator()->get('zfcuser_user_service')->getDefineRole());
        $requestService->setDbSession($this->getServiceLocator()->get('request_session'));
        $requestService->setApplicationOptions(new GridOptions());
        $logger=$this->getServiceLocator()->get('logger');
        $logger->openStream('request');
        $requestService->setLogger($logger);
		return $requestService;
	}

}

?>