<?php
 
namespace DmnRequestTestController;
 
use DmnRequestTest\Bootstrap;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use DmnAdmin\Controller\DmnRequestController;
use DmnAdmin\Service\DmnrequestServiceFactory as Dmnrequest;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
 
class DmnRequestTest extends AbstractHttpControllerTestCase
{
    protected $controller;
    protected $request;
    protected $response;
    protected $routeMatch;
    protected $event;
 
    protected function setUp()
    {
        $this->setApplicationConfig(
            include 'config/application.config.php'
        );
        parent::setUp();
    }
	public function testIndexActionCanBeAccessed()
{

    $this->dispatch('/dmnrequest');
    $this->assertResponseStatusCode(200);

    $this->assertModuleName('Dmnadmin');
    $this->assertControllerName('DmnAdmin\Controller\DmnRequest');
    $this->assertControllerClass('DmnRequestController');
    $this->assertMatchedRouteName('dmnrequest');
}
}