<?php
/**
 * Created by PhpStorm.
 * User: yastopchik
 * Date: 25.04.2017
 * Time: 19:33
 */

namespace Application\Factory\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Controller\ActsController;

class ActsControllerServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $actsService = $serviceLocator->getServiceLocator()->get('acts');

        $controller = new ActsController($actsService);

        return $controller;
    }
}