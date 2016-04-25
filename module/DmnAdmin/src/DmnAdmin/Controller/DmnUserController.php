<?php 
namespace DmnAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use DmnAdmin\Service\DmnuserService;
use Zend\View\Model\ViewModel; 

class DmnUserController extends AbstractActionController
{		
	protected $dbUser;
	
	public function __construct(DmnuserService $dbUser)
	{
		$this->dbUser = $dbUser;
	}
	public function indexAction()
	{ 
	  $view = new ViewModel();		  
	  $view->setTemplate('dmnadmin/dmnuser/index'); 	
	  return $view;
	}
	public function getorguserAction()
	{	
		$parameters = $this->getRequest()->getQuery();
	
		if($parameters){
			$this->dbUser->setQueryParametrs($parameters);
		}
	
		$response=$this->dbUser->getOrgUsers();
	
		return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));	
	}	
	public function getuserAction()
	{
			
		$parameters = $this->getRequest()->getQuery();
	
		if($parameters){
			$this->dbUser->setQueryParametrs($parameters);
		}
	
		$response=$this->dbUser->getUsers();
	
		return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	}
	public function edituserAction()
	{
			
		$orgid = (int) $this->params()->fromQuery('orgId', 0);
	
		if (is_int($orgid)&&!is_null($orgid)) {
	
			$parameters = $this->getRequest()->getPost();
	
			if($parameters){
	
				$this->dbUser->setPostParametrs($parameters);
	
				return $this->dbUser->editUser($orgid);
			}
		}
		return false;
	}
	public function editorguserAction()
	{
			
		$parameters = $this->getRequest()->getPost();
	
		if($parameters){
	
			$this->dbUser->setPostParametrs($parameters);
	
			return $this->dbUser->editOrgUser();
		}
		return false;
	}
	public function noobjectexistAction()
	{
			
		$parameters = $this->getRequest()->getPost();
	
		$result=true;
	
		if($parameters){
	
			$this->dbUser->setPostParametrs($parameters);
	
			$result=$this->dbUser->validateNoObjectExist();
		}
		return $this->getResponse()->setContent(json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	
	}
	public function getsezAction()
	{
			
		$response=$this->dbUser->getSez();
	
		return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	
	}
	  
}
