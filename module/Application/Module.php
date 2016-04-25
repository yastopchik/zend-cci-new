<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager = $e->getApplication()->getEventManager();
        $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, function (MvcEvent $event) {
            $viewModel = $event->getViewModel();
            $viewModel->setTemplate('layout/main');
        }, -200);
        $eventManager->attach($e->getApplication()->getServiceManager()->get('mail_listener'));
        $eventManager->getSharedManager()->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function ($e) {
            $controller = $e->getTarget();
            $controllerClass = get_class($controller);
            $moduleNamespace = str_replace("\\", "_", $controllerClass);
            $config = $e->getApplication()->getServiceManager()->get('config');
            $e->getViewModel()->setVariable('auth', $e->getApplication()->getServiceManager()->get('applicationauth'));
            $e->getViewModel()->setVariable('identity', $e->getApplication()->getServiceManager()->get('identityauth'));
            $e->getViewModel()->setVariable('active', array('route' => $e->getRouteMatch()->getMatchedRouteName(),
                'action' => $e->getRouteMatch()->getParam('action', 'index')));
            if (isset($config['module_layouts'][$moduleNamespace])) {
                $controller->layout($config['module_layouts'][$moduleNamespace]);
            }
        }, 100);
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        //$eventManager->attach('route', array($this, 'doHttpsRedirect'));
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function doHttpsRedirect(MvcEvent $e)
    {
        $sm = $e->getApplication()->getServiceManager();
        $uri = $e->getRequest()->getUri();
        $controller = $e->getRouteMatch()->getParam('controller');
        $action = $e->getRouteMatch()->getParam('action');
        $scheme = $uri->getScheme();
        if ($scheme != 'https') {
            $uri->setScheme('https');
            $response = $e->getResponse();
            $response->getHeaders()->addHeaderLine('Location', $uri);
            $response->setStatusCode(302);
            $response->sendHeaders();
            return $response;
        }
    }
}
