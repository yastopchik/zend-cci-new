<?php
/**
 * Created by PhpStorm.
 * User: yastopchik
 * Date: 13.04.2017
 * Time: 21:40
 */

namespace DmnAdmin\Factory\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DmnAdmin\Controller\DmnactController;

class DmnactControllerServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $dbContent = $serviceLocator->getServiceLocator()->get('dmn_act');

        $controller = new DmnActController($dbContent);

        return $controller;
    }
}