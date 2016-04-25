<?php

namespace DmnAdmin\Service;

use DmnDatabase\Service\AbstractServiceFactory;
use DmnAdmin\Options\GridOptions;

class DmnrequestServiceFactory extends AbstractServiceFactory
{

    protected function create()
    {
        $requestService = new DmnrequestService($this->getServiceLocator()->get('cache'));
        $requestService->setDbRequest($this->getServiceLocator()->get('db_request'));
        $requestService->setDbPriority($this->getServiceLocator()->get('db_priority'));
        $requestService->setDbOrganization($this->getServiceLocator()->get('db_organization'));
        $requestService->setDbStatus($this->getServiceLocator()->get('db_status'));
        $requestService->setDbForms($this->getServiceLocator()->get('db_forms'));
        $requestService->setDbLifecycle($this->getServiceLocator()->get('db_lifecycle'));
        $requestService->setDbUser($this->getServiceLocator()->get('db_user'));
        $requestService->setDbCountry($this->getServiceLocator()->get('db_country'));
        $requestService->setAuth($this->getServiceLocator()->get('zfcuser_user_service')->getUserAuthId());
        $requestService->setRole($this->getServiceLocator()->get('zfcuser_user_service')->getDefineRole());
        $requestService->setDbSession($this->getServiceLocator()->get('request_session'));
        $requestService->setOptions(new GridOptions());
        $logger = $this->getServiceLocator()->get('logger');
        $logger->openStream('request');
        $requestService->setLogger($logger);
        return $requestService;
    }

}

?>