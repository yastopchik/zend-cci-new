<?php 
namespace DmnAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use DmnAdmin\Service\DmnexecutorService;
use Zend\View\Model\ViewModel; 

class DmnExecutorController extends AbstractActionController
{
	protected $dbExecutor;
	
	public function __construct(DmnexecutorService $dbExecutor)
	{
		$this->dbExecutor = $dbExecutor;
	}	
	public function indexAction()
	{ 
	  $view = new ViewModel();		  
	  $view->setTemplate('dmnadmin/dmnexecutor/index'); 	
	  return $view;
	}
	public function getorgexecutorAction()
	{			
		$parameters = $this->getRequest()->getQuery();
	
		if($parameters){
			$this->dbExecutor->setQueryParametrs($parameters);
		}
	
		$response=$this->dbExecutor->getOrgExecutors();
	
		return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));	
	}
	public function getexecutorAction()
	{
			
		$parameters = $this->getRequest()->getQuery();
	
		if($parameters){
			$this->dbExecutor->setQueryParametrs($parameters);
		}
	
		$response=$this->dbExecutor->getExecutors();
	
		return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	}
	public function getcityAction()
	{
			
		$id = (int) $this->params()->fromRoute('id', 0);
	
		$response=$this->dbExecutor->getExecutorCities();
	
		return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));	
	
	}
	public function editorgexecutorAction()
	{
			
		$parameters = $this->getRequest()->getPost();
	
		if($parameters){
				
			$this->dbExecutor->setPostParametrs($parameters);
				
			return $this->dbExecutor->editOrgExecutor();
		}
		return false;
	}
	public function editexecutorAction()
	{
			
		$orgid = (int) $this->params()->fromQuery('orgId', 0);
		
		if (is_int($orgid)&&!is_null($orgid)) {
				
			$parameters = $this->getRequest()->getPost();
	
			if($parameters){
	
				$this->dbExecutor->setPostParametrs($parameters);
	
				return $this->dbExecutor->editExecutor($orgid);
			}
		}
		return false;
	}
	public function getroleAction()
	{
			
		$response=$this->dbExecutor->getRole();
	
		return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		
	}
	public function noobjectexistAction()
	{
			
		$parameters = $this->getRequest()->getPost();
	
		$result=true;
		
		if($parameters){
				
			$this->dbExecutor->setPostParametrs($parameters);
				
			$result=$this->dbExecutor->validateNoObjectExist();
		}
		return $this->getResponse()->setContent(json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	
	}
	  
}
