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
    public function testRequestAccessed()
    {
        $this->dispatch('dmnrequest');
        $this->assertResponseStatusCode(404);
    }
	public function testGetRequestNumberbeAccessed()
    {
    $getData = array(
        '_search'=>false,
        'nd'=>1461846412862,
        'page'=>1,
        'rows'=>5,
        'sidx'=>'id','sord'=>'desc'
    );
    $this->dispatch('dmnrequest/getrequestnumber', 'GET', $getData);
    $this->assertResponseStatusCode(404);
    }
    public function testGetRequestbeAccessed()
    {
    $getData = array(
        '_search'=>false,
        'id'=>0,
        'nd'=>1461846412906,
        'page'=>1,
        'rows'=>15,
        'sidx'=>'item','sord'=>'asc'
    );
    $this->dispatch('/dmnrequest/getrequest', 'GET', $getData);
    $this->assertResponseStatusCode(200);
    }
    public function testGetRequestDescbeAccessed()
    {
        $getData = array(
            '_search'=>false,
            'id'=>0,
            'nd'=>1461846412940,
            'page'=>1,
            'rows'=>15,
            'sidx'=>'item','sord'=>'asc'
        );
        $this->dispatch('/dmnrequest/getrequestdesc', 'GET', $getData);
        $this->assertResponseStatusCode(200);
    }
    public function testGetCountryByIdbeAccessed()
    {
        $getData = array(
            'id'=>2
        );
        $this->dispatch('/dmnrequest/getcountrybyid', 'GET', $getData);
        $this->assertResponseStatusCode(200);
    }
}