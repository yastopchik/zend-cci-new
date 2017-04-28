<?php
/**
 * Created by PhpStorm.
 * User: yastopchik
 * Date: 28.04.2017
 * Time: 9:02
 */

namespace DmnExecutor\Factory\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DmnExecutor\Controller\DmnExactsController;

class DmnexactsControllerServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $actsService = $serviceLocator->getServiceLocator()->get('dmn_exacts');

        $controller = new DmnExactsController($actsService);

        return $controller;
    }
}