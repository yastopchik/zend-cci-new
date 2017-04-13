<?php
/**
 * Created by PhpStorm.
 * User: yastopchik
 * Date: 13.04.2017
 * Time: 21:35
 */

namespace DmnAdmin\Service;

use DmnDatabase\Service\AbstractServiceFactory;

class DmnactServiceFactory extends AbstractServiceFactory 
{
    protected function create() 
    {
        $actService = new DmnactService();
        $actService->setDbContent($this->getServiceLocator()->get('db_act'));
        //$contentService->setAuth($this->getServiceLocator()->get('zfcuser_user_service')->getUserAuthId());
        $logger=$this->getServiceLocator()->get('logger');
        $logger->openStream('act');
        $actService->setLogger($logger);

        return $actService;
    }
}