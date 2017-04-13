<?php
/**
 * Created by PhpStorm.
 * User: yastopchik
 * Date: 13.04.2017
 * Time: 21:15
 */

namespace DmnDatabase\Service;

use DmnDatabase\Service\AbstractServiceFactory;

class ActServiceFactory extends AbstractServiceFactory
{

    protected function create()
    {
        $service = new ActService($this->getServiceLocator()->get('DmnDatabase\Data\ActMapper'));
        return $service;
    }

}