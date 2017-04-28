<?php

namespace DmnExecutor\Service;

use DmnDatabase\Service\AbstractServiceFactory;
use DmnAdmin\Options\GridOptions;

class DmnexactsServiceFactory extends AbstractServiceFactory
{
    protected function create()
    {
        $actService = new DmnexactsService($this->getServiceLocator()->get('cache'));
        $actService->setDbActService($this->getServiceLocator()->get('db_act'));
        $actService->setDbOrganization($this->getServiceLocator()->get('db_organization'));
        $actService->setOptions(new GridOptions());
        $actService->setAuth($this->getServiceLocator()->get('zfcuser_user_service')->getUserAuthId());
        $actService->setRole($this->getServiceLocator()->get('zfcuser_user_service')->getDefineRole());
        $logger=$this->getServiceLocator()->get('logger');
        $logger->openStream('act');
        $actService->setLogger($logger);

        return $actService;
    }
}