<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DmnAdmin\Service\DmncontentService as ContentService;

class IndexController extends AbstractActionController
{
	const CONTROLLER_NAME    = 'zfcuser';
	
	protected $dbContent;
	
	public function __construct(ContentService $dbContent)
	{
		$this->dbContent = $dbContent;
	}
	
	public function indexAction()
    {  
    	/*$need=round(((235/0.296)-50), 0); 
    	$string=array(
    	substr($t, 0, strrpos(substr($t, 0, $need), ' ')),
    	substr($t, strrpos(substr($t, 0, $need), ' ')));
    	/*$str1=substr($t, 0, $need);
    	$str2=substr($t, $need);
    	$str3=strstr($str2, '');
    	$str4=substr(strrchr($PATH, ":"), 1);*/
        /*$remote = new \Zend\Http\PhpEnvironment\RemoteAddress;
        $ip=$remote->getIpAddress();
        $sxgeo=$this->getServiceLocator()->get('sxgeo');
        $country = $sxgeo->getCountry($ip);
        $city = $sxgeo->getCityFull($ip);*/
    	if($this->getRequest()->isXmlHttpRequest()) {
		    $forward=$this->forward()->dispatch(static::CONTROLLER_NAME, array('action' => 'authenticate'));
			return $this->getResponse()->setContent(json_encode($forward->getVariables(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		} else {
		    return $this->forward()->dispatch(static::CONTROLLER_NAME, array('action' => 'login'));   
		}
    	/*$upload=$this->getServiceLocator()->get('dmn_upload');
    	$response = $this->getResponse();
    	$response->getHeaders()->clearHeaders()->addHeaders(array(
    			'Pragma' => 'public',
    			'Content-Type' => 'application/vnd.ms-excel',
    			'Content-Disposition' => 'attachment;filename="CT-1_'.date('Y_m_d(H:i:s)').'.xls"',
    			'Cache-Control' => 'max-age=0'
    	));
    	$id =17;//$this->params()->fromQuery('id', 0);
    	if(!is_null($id)){
    		$upload->setId($id);
    		$upload->setFileName('maketCT-1Print.xls');
    		ob_start();
    		$upload->downloadPrint();
    		$excelOutput = ob_get_clean();
    		$response->setContent($excelOutput);
    	}
    	return $response;
    }	
    	
   $this->getRequest()->setQuery(new \Zend\Stdlib\Parameters(array(
    		'id'=>'18',
    )));*/
    /*$dbRequest=$this->getServiceLocator()->get('db_request');  
        $dbRequest->setAuth(13);
         
        $dbRequest->setRole(4);
    
    $data=$dbRequest->getRequestNumber();*/
     
    	/*$dbRequest=$this->getServiceLocator()->get('dmn_request');
    	    	
    	$result=$dbRequest->clearSession();
    	
    	return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    	$dbUpload=$this->getServiceLocator()->get('dmn_upload');
    	  
    	$dbUpload->checkLog();*/
    	/*$upload=$this->getServiceLocator()->get('dmn_upload');
    	$response = $this->getResponse();  
    	$response->getHeaders()->clearHeaders()->addHeaders(array(
    			'Pragma' => 'public',
    			'Content-Type' => 'application/vnd.ms-excel',
    			'Content-Disposition' => 'attachment;filename="CT-1_'.date('Y_m_d(H:i:s)').'.xls"',
    			'Cache-Control' => 'max-age=0'
    	));    	   	
    	$id =1;//$this->params()->fromQuery('id', 0);
    	if(!is_null($id)){
    		$upload->setId($id);    		   		
    		$upload->setFileName('maketCT-1Print.xls');    		
    		ob_start();
    		$upload->downloadPrint();
    		$excelOutput = ob_get_clean();    		 
    		$response->setContent($excelOutput);
    	}
    	return $response;	    	
    	
    	/*$this->getRequest()->setQuery(new Parameters(array(
    			'id'=>'21',
    			
    	)));
    	
    	
    	$dbRequest=$this->getServiceLocator()->get('dmn_exrequest');
    	
    	$parameters = $this->getRequest()->getQuery();
		
		if($parameters){
			
			$dbRequest->setQueryParametrs($parameters);
		}
		$result=$dbRequest->SaveRequestFromSession();
	
		return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));    	
    	/*$dbUpload=$this->getServiceLocator()->get('dmn_upload');
    	
    	$dbUpload->checkLog();*/
    	
    	/*$parameters = $this->getRequest()->getQuery();
    	
    	if($parameters){
    		$dbExecutor->setQueryParametrs($parameters);
    	}
    	
    	$response=$dbExecutor->getOrgUsers();
    	
    	return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    	
    	*/    
            
        /*$orgid=1;
    	$this->getRequest()->setPost(new  \Zend\Stdlib\Parameters(array(  
    		'activate'=>'1',
    		'email'=>'bartat@cci.by',    		
    		'executor'=>'Барятинская Татьяна Юрьевна',
    	    'id'=>'3',
    	    'login'=>'bartat',
    	    'nameshort'=>'Барятинская Т.Ю.',
    	    'oper'=>'edit',
    	    'phone'=>'778038',
    	    'position'=>'Ведущий эксперт',
    	    'roleRus'=>'4'
    		  		
       ))); 
    	$dbExecutor=$this->getServiceLocator()->get('dmn_executor');
            $parameters = $this->getRequest()->getPost();
	
			if($parameters){
	
				$dbExecutor->setPostParametrs($parameters);
	
				return $dbExecutor->editExecutor($orgid);
			}
    	
    	
    	*/
		/*$orgid = 1;
		
		if (is_int($orgid)&&!is_null($orgid)) {
		
			$this->getRequest()->setPost(new \Zend\Stdlib\Parameters(array(					
					'organizationid'=>$orgid,						
			)));
		}*/
		
		/*$parameters = $this->getRequest()->getPost();
	
		if($parameters){
	
			$dbExecutor->setPostParametrs($parameters);
	
			return $dbExecutor->editExecutor();
		}
    	
    	/*$name="CT-1_".date('Y_m_d(H:i:s)').".xls";
    	$response = $this->getResponse();
    	$response->getHeaders()->clearHeaders();  
    	$upload=$this->getServiceLocator()->get('dmn_upload');
    	$actions =  $this->params()->fromQuery('actions', 0);
    	$id =  $this->params()->fromQuery('id', 0);
    	if(!is_null($id)&&!is_null($actions)){
    		$upload->setId($id);
    		$upload->setActions($actions);    		
    		$upload->setFileName('maketCT-1.xls');
    		ob_start();
    		$upload->download();
    		$excelOutput = ob_get_clean();    		 
    		$response->setContent($excelOutput);
    	}
		*/
    	/*$upload=$this->getServiceLocator()->get('dmn_upload');
    	$upload->setId(29);
    	$upload->downloadXml();   	
    	/*$dbRequest=$this->getServiceLocator()->get('dmn_request');
    	
    	$parameters = $this->getRequest()->getPost();
    	
    	if($parameters){
    			
    		$dbRequest->setPostParametrs($parameters);
    			
    		return $dbRequest->editRequestNumber();
    	}
    	return false;*/
/*     $dbRequest=$this->getServiceLocator()->get('db_request');
     
    /* $current_status=$dbRequest->getStatusByRequestId(9)->getSingleScalarResult();
     /*
     $result=$dbRequest->SaveRequestFromSession();
	
		$parameters = $this->getRequest()->getPost();
	
		if($parameters){
	
			$dbRequest->setPostParametrs($parameters);
	
			return $dbRequest->editSessionRequestDescValue();
		}
	*/	
    }
		public function contentAction()
    {  
    	$id =  $this->params()->fromRoute('id', '');
    	$view=new ViewModel();
		$this->layout('layout/main');		
		$this->dbContent->setId($id);
		$help=$this->dbContent->getContentById();
		$view->setTemplate('application/index/help');
		$view->setVariable('help', $help);
        return $view;
    }  
    public function helpAction()
    {
        $id =  $this->params()->fromRoute('id', '');
        $view=new ViewModel();
        $view->setTerminal(true);
        $this->dbContent->setId($id);
        $help=$this->dbContent->getContentById();
        $view->setTemplate('application/index/help');
        $view->setVariable('help', $help);
        return $view;
    }
}
