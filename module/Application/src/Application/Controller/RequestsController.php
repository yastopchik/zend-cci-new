<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Service\RequestsService;
use Zend\View\Model\ViewModel;


class RequestsController extends AbstractActionController
{
	protected $requestsService;
	
	public function __construct(RequestsService $requestsService)
	{
		$this->requestsService = $requestsService;		
	}    
	
    public function indexAction ()
    {       
        $view = new ViewModel(); 
        $view->setTemplate("application/requests/index");	
        return $view;  
    }
    public function addAction()
    {
    	$view = new ViewModel();  
    	$this->requestsService->clearSession();
    	$view->setTemplate('application/requests/add');     	
    	return $view;
    }
    public function uploadAction()
    {
    	$view = new ViewModel();
    	$response = $this->getResponse();
    	$response->getHeaders()->clearHeaders()->addHeaders(array(
    			'Pragma' => 'no-cache',
    			'Last-Modified' => gmdate("D, d M Y H:i:s") . " GMT",
    			'Cache-Control' => 'no-store, no-cache, must-revalidate',
    	));
    	$upload=$this->requestsService->getUploadService();
    	//For the executor set his authentication id
    	$upload->setAuth($this->requestsService->getAuth());
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$post = $request->getPost()->toArray();
    		if (isset($post ["name"])) {
    			$File = $post ["name"];
    		} elseif (!empty($_FILES)) {
    			$files=$request->getFiles()->toArray();
    			$File = $files["file"]["name"];
    		}
    		$upload->setFileName($File);
    		$data = array_merge( $post,  array('fileupload'=> $File));
    		$adapter=$upload->getAdapter($data);
    		if (isset($adapter)&&($adapter->isValid())){
    			$adapter->setDestination($upload->getDirectory());
    		    if ($adapter->receive($File)) {	  		    
	  			$error=$upload->uploadFileToDatabase();
	  			if(is_array($error)){
	  			    foreach ($error as $err){
	  			        if(!$err){
	  			            $upload->deleteFileFromDirectory();
	  			            return $this->getResponse()->setContent(json_encode(array('success'=>true), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	  			        }else{
	  			            return $this->getResponse()->setContent(json_encode(array('jsonrpc'=>'2.0', 'error'=>array('code'=>100, 'message'=>$err),'id'=>'id'), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	  			            
	  			        }
	  			    }
	  			}	  			
	  		 }
    		}else{
    			$dataError = $adapter->getMessages();
    			foreach($dataError as $key=>$row){
    		  	
    				return $this->getResponse()->setContent(json_encode(array('jsonrpc'=>'2.0', 'error'=>array('code'=>100, 'message'=>$row),'id'=>'id'), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    			}
    		}
    		$upload->deleteFileFromDirectory();
    	}
    	$view->setTemplate('application/requests/upload');
    	return $view;
    }
    public function downloadxlsAction()
    {
    	$response = $this->getResponse();
    	$response->getHeaders()->clearHeaders()->addHeaders(array(
    			'Pragma' => 'public',
    			'Content-Type' => 'application/vnd.ms-excel',
    			'Content-Disposition' => 'attachment;filename="CT-1_'.date('Y_m_d(H:i:s)').'.xls"',
    			'Cache-Control' => 'max-age=0'
    	));
    	$id =  $this->params()->fromQuery('id', 0);
    	if(!is_null($id)){
    		$upload=$this->requestsService->getUploadService();
    		$upload->setId($id);
    		$upload->setFileName('maketCT-1.xls');
    		ob_start();
    		$upload->downloadXls();
    		$excelOutput = ob_get_clean();
    		$response->setContent($excelOutput);
    	}
    	return $response;
    }
    public function getrequestnumberAction()
    {    	
    
    	$parameters = $this->getRequest()->getQuery();
    
    	if($parameters){
    		
    		$this->requestsService->setQueryParametrs($parameters);
    	}
    
    	$response=$this->requestsService->getRequestNumber();
    
    	return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    
    }
    public function getrequestAction()
    {    	
    
    	$parameters = $this->getRequest()->getQuery();
    
    	if($parameters){
    		
    		$this->requestsService->setQueryParametrs($parameters);
    	}
    
    	$response=$this->requestsService->getRequest();
    
    	return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    		
    }
    public function getoptionAction()
    {
    
    	$parameters = $this->getRequest()->getQuery();
    
    	if($parameters){
    		
    		$this->requestsService->setQueryParametrs($parameters);
    	}
    
    	$response=$this->requestsService->getOption();
    
    	return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    		
    }
    public function getaddrequestAction()
    {
    
    	$response=$this->requestsService->getRequestForAdd();
    
    	return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    
    }
    public function getaddrequestdescAction()
    {
    	
    	$response=$this->requestsService->getRequestDescForAdd();
    
    	return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    
    }
    public function getrequestdescAction()
    {
    
    	$parameters = $this->getRequest()->getQuery();
    
    	if($parameters){
    		
    		$this->requestsService->setQueryParametrs($parameters);
    	}
    
    	$response=$this->requestsService->getRequestDescription();
    
    	return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }     
    public function getlifecycleAction()
    {
    	$view = new ViewModel();	
		
		$view->setTerminal(true);
	
		$parameters = $this->getRequest()->getQuery();
	
		if($parameters){
			$this->requestsService->setQueryParametrs($parameters);
		}
		$data=$this->requestsService->getLifeCycle();	
		
		$view->setVariable('data', $data);
    
    	$view->setTemplate('application/requests/show');  
    
    	return $view;
    		
    }
    public function editrequestnumberAction()
    {    
    	$parameters = $this->getRequest()->getPost();
    
    	if($parameters){
    			
    		$this->requestsService->setPostParametrs($parameters);
    			
    		return $this->requestsService->editRequestNumber();
    	}
    	return false;
    }
    public function editrequestdescAction()
    {
    
    	$parameters = $this->getRequest()->getPost();
    
    	if($parameters){
    
    		$this->requestsService->setPostParametrs($parameters);
    
    		return $this->requestsService->editRequestDescription();
    	}
    	return false;
    }
    public function editrequestAction()
    {
    
    	$parameters = $this->getRequest()->getPost();
    
    	if($parameters){
    
    		$this->requestsService->setPostParametrs($parameters);
    
    		return $this->requestsService->editRequest();
    	}
    	return false;
    }
    public function addrequestAction()
    {
    	$parameters = $this->getRequest()->getPost();
    
    	if($parameters){    		
    
    		$this->requestsService->setPostParametrs($parameters);
    
    		return $this->requestsService->editSessionRequestValue();
    	}
    	return false;
    }
    public function addrequestdescAction()
    {   	
    
    	$parameters = $this->getRequest()->getPost();
    
    	if($parameters){
    
    		$this->requestsService->setPostParametrs($parameters);
    
    		return $this->requestsService->editSessionRequestDescValue();
    	}
    	return false;
    }
    public function saveAction()
    {
    
    	$result=$this->requestsService->SaveRequestFromSession();
    
    	return $this->getResponse()->setContent(json_encode('ะะบ', JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }    
}