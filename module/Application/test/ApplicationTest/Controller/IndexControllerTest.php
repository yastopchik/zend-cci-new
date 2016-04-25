<?php
 
namespace ApplicationTestController;
 
use ApplicationTest\Bootstrap;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Application\Controller\IndexController;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use PHPUnit_Framework_TestCase;
 
class IndexControllerTest extends PHPUnit_Framework_TestCase
{
    protected $controller;
    protected $request;
    protected $response;
    protected $routeMatch;
    protected $event;
 
    protected function setUp()
    {
        $serviceManager = Bootstrap::getServiceManager();
        $this->controller = new IndexController();
        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(array('controller' => 'index'));
        $this->event      = new MvcEvent();
        $config = $serviceManager->get('Config');
		$doctrine = $serviceManager->get('doctrine.entitymanager.orm_default');
        $routerConfig = isset($config['router']) ? $config['router'] : array();
        $router = HttpRouter::factory($routerConfig);
 
        $this->event->setRouter($router);
        $this->event->setRouteMatch($this->routeMatch);
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($serviceManager);
    }
	public function testIndexActionCanBeAccessed()
{
    /*$this->routeMatch->setParam('action', 'index');
 
    $result   = $this->controller->dispatch($this->request);
    $response = $this->controller->getResponse();
 
    $this->assertEquals(200, $response->getStatusCode());*/
    $serviceManager = Bootstrap::getServiceManager();
    $cache=$serviceManager->get('cache');
    // $cache = $this->getServiceLocator()->get('cache');
    
    $cache->setItem('a', 'b');
    for ($i = 1; $i <= 7; $i++) {
        sleep(1);
        echo "var_dump on {$i}th second ... ";
        var_dump($cache->getItem('a'));
    }
}
}