<?php
/**
 * Created by PhpStorm.
 * User: yastopchik
 * Date: 27.04.2017
 * Time: 8:36
 */

namespace Application\Service;

use DmnDatabase\Service\AbstractServiceFactory;

class UserServiceFactory extends AbstractServiceFactory
{
    protected function create()
    {
        $actService = new User();
        $actService->setApplicationauth($this->getServiceLocator()->get('applicationauth'));
        return $actService;
    }
}