<?php 
namespace DmnAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use DmnAdmin\Service\DmnuploadService;
use Zend\View\Model\ViewModel; 

class DmnUploadController extends AbstractActionController
{
	protected $upload;
	
	public function __construct(DmnuploadService $upload)
	{
		$this->upload = $upload;
	}	
	
	public function indexAction()
	{ 
	  $view = new ViewModel();	 
	  $response = $this->getResponse();
	  $response->getHeaders()->clearHeaders()->addHeaders(array(
	  		'Pragma' => 'no-cache',
	  		'Last-Modified' => gmdate("D, d M Y H:i:s") . " GMT",
	  		'Cache-Control' => 'no-store, no-cache, must-revalidate',	  		
	  ));	  
	  $request = $this->getRequest();
	  //if select organization and client controller get user id
	  if ($request->isPost()) {	
	  	$this->upload->setId($this->getRequest()->getQuery()->get('id', null));
	  	$post = $request->getPost()->toArray();	
	  	if (isset($post ["name"])) {
	  		$File = $post ["name"];
	  	} elseif (!empty($_FILES)) {
	  		$files=$request->getFiles()->toArray();
	  		$File = $files["file"]["name"];
	  	}
	  	$this->upload->setFileName($File);
	  	$data = array_merge( $post,  array('fileupload'=> $File));
	  	$adapter=$this->upload->getAdapter($data);  	  	
	  	if (isset($adapter)&&($adapter->isValid())){
	  		$adapter->setDestination($this->upload->getDirectory());
	  		if ($adapter->receive($File)) {	  		    
	  			$error=$this->upload->uploadFileToDatabase();
	  			if(is_array($error)){
	  			    foreach ($error as $err){
	  			        if(!$err){
	  			            $this->upload->deleteFileFromDirectory();
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
	  	$this->upload->deleteFileFromDirectory();
	  }	
	 
	  $view->setTemplate('dmnadmin/dmnupload/index'); 	
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
    		$this->upload->setId($id);    		   		
    		$this->upload->setFileName('maketCT-1.xls');    		
    		ob_start();
    		$this->upload->downloadXls();
    		$excelOutput = ob_get_clean();    		 
    		$response->setContent($excelOutput);
    	}
    	return $response;		 
	}
	public function downloadprintAction()
	{
		$response = $this->getResponse();
		$response->getHeaders()->clearHeaders()->addHeaders(array(
				'Pragma' => 'public',
				'Content-Type' => 'application/application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
				'Content-Disposition' => 'attachment;filename="CT-1_'.date('Y_m_d(H:i:s)').'.xls"',
				'Cache-Control' => 'max-age=0'
		));
		$id =  $this->params()->fromQuery('id', 0);		
		if(!is_null($id)){
			$this->upload->setId($id);	
			$fileName=$this->upload->getFileNameById();
			if(!empty($fileName['workorder'])){
			    ob_start();
			    $this->upload->downloadPrint();
			    $excelOutput = ob_get_clean();
			    $response->setContent($excelOutput);
			}else{
			    return $response->setContent('errorНе введен номер сертификата');
			}
		}		
		return $response;
	}
	public function downloadxmlAction()
	{		
		$id =  $this->params()->fromQuery('id', 0);		
		$response = $this->getResponse();  
    	$response->getHeaders()->clearHeaders()->addHeaders(array(
    			'Pragma' => 'public',
    			'Content-Type' => 'application/xml',
    			'Cache-Control' => 'max-age=0'
    	));				
		if(!is_null($id)){			
			$this->upload->setId($id);
			$fileName=$this->upload->getFileNameById();
			$xml= $this->getServiceLocator()->get('dmn_xml');
			$xml->setEncoding('windows-1251');
			if(!empty($fileName['workorder'])){
				$response->getHeaders()->addHeaderLine('Content-Disposition', 'attachment;filename="'.$fileName['workorder'].'.xml"');
				$this->upload->setFileName($fileName['workorder']);
				$writer= $this->upload->downloadXml();				
			}else{
				$writer= array('error'=>'Не введен номер сертификата');
			}		
			$xml->setRootName('cert');
			$response->setContent($xml->convert($writer));
		}
		
		return $response;
	}
	public function uploadxmlAction()
	{	    
	    $response = $this->getResponse();  
        $date=new \DateTime('NOW');
        $data=$this->upload->getRequestNumbersByDate($date);

        if(is_array($data) && count($data)>0){
            $directory='1C/download/'.$date->format('d_m_Y');
            if(is_dir($directory))
            $this->upload->delTree($directory);
            mkdir($directory, 0777, true);
            $xml= $this->getServiceLocator()->get('dmn_xml');
            foreach ($data as $key=>$value){
                $this->upload->setId($value['id']);
                $xml->setEncoding('windows-1251');
                $xml->setFile($directory.'/'.$value['id'].'.xml');
                $writer= $this->upload->downloadXml();
                $xml->setRootName('cert');
                $xml->convertToFile($writer);
                $xml->flush();
            }
        }
	    return $response;
	}
	public function reqxmlAction()
	{
	    $response = $this->getResponse();
	    $date=new \DateTime('NOW');
	    $data=$this->upload->getRequestNumbersByStatus();	
	    if(is_array($data) && count($data)>0){
	        $directory='1C/request/'.$date->format('d_m_Y');
	        if(is_dir($directory))
	            $this->upload->delTree($directory);
	        mkdir($directory, 0777, true);
	        $xml= $this->getServiceLocator()->get('dmn_xml');
	        foreach ($data as $key=>$value){
	            $this->upload->setId($value['id']);
	            $xml->setEncoding('windows-1251');
	            $xml->setFile($directory.'/'.$value['id'].'.xml');
	            $writer= $this->upload->downloadXml();
	            $xml->setRootName('cert');
	            $xml->convertToFile($writer);
	            $xml->flush();
	            $data=$this->upload->getRequestService()->fillXmlUnloading($value, $date);
	        }
	    }
	    return $response;
	}
	
	  
}
