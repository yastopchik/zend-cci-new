<?php 
namespace DmnFea\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel; 
use DmnFea\Service\DmnfeaService;
use DmnFea\Form\FeaForm;
use DmnFea\Form\FeaFilter;
use DmnFea\Form\FeaVisitForm;
use DmnFea\Form\FeaVisitFilter;

class DmnFeaController extends AbstractActionController
{		
	protected $dbFea;
	
	public function __construct(DmnfeaService $dbFea)
	{
		$this->dbFea = $dbFea;
	}
	public function indexAction()
	{ 	  
	   $view = new ViewModel();	      
	   $request = $this->getRequest();
	   $url =  $this->params()->fromRoute('url', '');
	   $form=new FeaForm($this->dbFea->parseMainSite($url));
	   if ($request->isPost()) {	                  
		 $filter = new FeaFilter();                                       
		 $form->setInputFilter($filter->getInputFilter());            
		 $form->setData($request->getPost());         
		 if ($form->isValid()) { 
		     $post = $request->getPost()->toArray();
		     $files=$request->getFiles()->toArray();
		     if($files['fileupload']){
		     	if(isset($value['size']) && $value['size']!=0){
		         $adapter = new \Zend\File\Transfer\Adapter\Http();
		         $size = new \Zend\Validator\File\Size(array('max'=>1500000));
		         $extension = new \Zend\Validator\File\Extension(array('extension' => array('jpg', 'jpeg', 'gif', 'pdf', 'doc', 'docx', 'bmp'),
		                 'messages' => array( \Zend\Validator\File\Extension::FALSE_EXTENSION => "Только файлы с расширением 'jpg', 'jpeg', 'gif', 'pdf', 'doc', 'docx', 'bmp'" )));
		         foreach ($files['fileupload'] as $key => $value) {
		             $adapter->setValidators(array($size, $extension), $value['name']);
		             if (isset($adapter)&&($adapter->isValid($value['name']))){
		                 $adapter->setDestination($this->dbFea->getDirectory());
		                 $adapter->receive($value['name']);
		             } else {
		                 foreach($adapter->getMessages() as $key=>$row) {
		                     $error = $row;
		                 }
		                 $form->setMessages(array('fileupload'=>array($error)));
		                 $view->setTemplate('dmnfea/dmnfea/fea');
                         $view->setVariable('url', $url);
	                     $view->setVariable('form', $form);
	                     return $view; 	
		             }
		         }
		         } else {
		         	unset($files['fileupload'][$key]);
		         }
		         if(isset($files) && is_array($files))	
	             $data = array_merge_recursive($post, $files);
	             else
	             $data=$post;
		     }else{
		         $data=$post;
		     }		     
		     $this->dbFea->feaReqToDatabase($data);
			 $view->setTemplate('dmnfea/dmnfea/feasuccess');
			 return $view;
		  }       
		}
	 $view->setTemplate('dmnfea/dmnfea/fea');
     $view->setVariable('url', $url);
	 $view->setVariable('form', $form);
	 return $view; 	 
	}
	public function visitAction()
	{
	    $view = new ViewModel();
	    $request = $this->getRequest();
	    $url =  $this->params()->fromRoute('url', '');	    
	    $form=new FeaVisitForm($this->dbFea->parseMainSite($url));
	    if ($request->isPost()) {
	        $filter = new FeaVisitFilter();
	        $form->setInputFilter($filter->getInputFilter());
	        $form->setData($request->getPost());
	        if ($form->isValid()) {	
	            $post = $request->getPost()->toArray();	            
	            $files=$request->getFiles()->toArray();	            
	            if($files['fileupload']){	
	                $adapter = new \Zend\File\Transfer\Adapter\Http();
	                $size = new \Zend\Validator\File\Size(array('max'=>1500000));
	                $extension = new \Zend\Validator\File\Extension(array('extension' => array('jpg', 'jpeg', 'gif', 'pdf', 'doc', 'docx', 'bmp'),
	                        'messages' => array( \Zend\Validator\File\Extension::FALSE_EXTENSION => "Только файлы с расширением 'jpg', 'jpeg', 'gif', 'pdf', 'doc', 'docx', 'bmp'" )));	                 
	                foreach ($files['fileupload'] as $key => $value) {
	                	if(isset($value['size']) && $value['size']!=0){
	                    	                    $adapter->setValidators(array($size, $extension), $value['name']);
	                    if (isset($adapter)&&($adapter->isValid($value['name']))){
	                        $adapter->setDestination($this->dbFea->getDirectory());
	                        $adapter->receive($value['name']);
	                    } else { 	                        
	                        foreach($adapter->getMessages() as $key=>$row) {
	                            $error = $row;
	                        }	                        
	                        $form->setMessages(array('fileupload'=>array($error)));
	                        $visa =  $this->params()->fromRoute('visa', '');
	                        if($visa==0)
	                            $view->setTemplate('dmnfea/dmnfea/feavisit');
	                        else
	                            $view->setTemplate('dmnfea/dmnfea/feavisitmilan');
	                        $view->setVariable('url', $url);
	                        $view->setVariable('form', $form);
	                        return $view;
	                    }
	                  } else {
	                  	unset($files['fileupload'][$key]);
	                  }
	                }
	                if(isset($files) && is_array($files))	
	                $data = array_merge_recursive($post, $files);
	                else
	                $data=$post;
	            }else{
	                $data=$post;
	            }
	            $this->dbFea->setVisit(1);
	            $this->dbFea->feaReqToDatabase($data);
	            $view->setTemplate('dmnfea/dmnfea/feasuccess');
	            return $view;
	        }
	    }
	    $visa =  $this->params()->fromRoute('visa', '');
	    if($visa==0)
	    $view->setTemplate('dmnfea/dmnfea/feavisit');
	    else 
	    $view->setTemplate('dmnfea/dmnfea/feavisitmilan');
	    $view->setVariable('url', $url);
	    $view->setVariable('form', $form);
	    return $view;
	}
    public function translateAction()
	{
	    $view = new ViewModel();
	    $request = $this->getRequest();	   
	    $form=new \DmnFea\Form\FeaTranslateForm();
	    if ($request->isPost()) {
	        $filter = new \DmnFea\Form\FeaTranslateFilter();
	        $form->setInputFilter($filter->getInputFilter());
	        $form->setData($request->getPost());
	        if ($form->isValid()) {
	            $post = $request->getPost()->toArray();
	            $files=$request->getFiles()->toArray();
	            if($files['fileupload']){
	                $adapter = new \Zend\File\Transfer\Adapter\Http();
	                $size = new \Zend\Validator\File\Size(array('max'=>1500000));
	                $extension = new \Zend\Validator\File\Extension(array('extension' => array('jpg', 'jpeg', 'gif', 'pdf', 'doc', 'docx', 'bmp'),
	                        'messages' => array( \Zend\Validator\File\Extension::FALSE_EXTENSION => "Только файлы с расширением 'jpg', 'jpeg', 'gif', 'pdf', 'doc', 'docx', 'bmp'" )));
	                foreach ($files['fileupload'] as $key => $value) {
	                    if(isset($value['size']) && $value['size']!=0){
	                        $adapter->setValidators(array($size, $extension), $value['name']);
	                        if (isset($adapter)&&($adapter->isValid($value['name']))){
	                            $adapter->setDestination($this->dbFea->getDirectory());
	                            $adapter->receive($value['name']);
	                        } else {
	                            foreach($adapter->getMessages() as $key=>$row) {
	                                $error = $row;
	                            }
	                            $form->setMessages(array('fileupload'=>array($error)));	
	                            $view->setTemplate('dmnfea/dmnfea/featranslate');  
	                            $view->setVariable('form', $form);
	                            return $view;
	                        }
	                    } else {
	                        unset($files['fileupload'][$key]);
	                    }
	                }
	                if(isset($files) && is_array($files))
	                    $data = array_merge_recursive($post, $files);
	                else
	                    $data=$post;
	            }else{
	                $data=$post;
	            }
	            $this->dbFea->setTranslate(1);
	            $this->dbFea->feaReqToDatabase($data);
	            $view->setTemplate('dmnfea/dmnfea/feasuccess');
	            return $view;
	        }
	    }	    
	   
	    $view->setTemplate('dmnfea/dmnfea/featranslate');	    
	    $view->setVariable('form', $form);
	    return $view;
	}
	
}
