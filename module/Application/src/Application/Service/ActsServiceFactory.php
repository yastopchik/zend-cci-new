<?php
/**
 * Created by PhpStorm.
 * User: yastopchik
 * Date: 25.04.2017
 * Time: 19:38
 */

namespace Application\Service;

use DmnDatabase\Service\AbstractServiceFactory;
use Application\Options\GridOptions;

class ActsServiceFactory extends AbstractServiceFactory
{
    protected function create()
    {
        $actService = new ActsService($this->getServiceLocator()->get('cache'));
        $actService->setDbActService($this->getServiceLocator()->get('db_act'));
        $actService->setDbOrganization($this->getServiceLocator()->get('db_organization'));
        $actService->setApplicationOptions(new GridOptions());
        $actService->setAuth($this->getServiceLocator()->get('zfcuser_user_service')->getUserAuthId());
        $actService->setRole($this->getServiceLocator()->get('zfcuser_user_service')->getDefineRole());
        $logger=$this->getServiceLocator()->get('logger');
        $logger->openStream('act');
        $actService->setLogger($logger);

        return $actService;
    }
}