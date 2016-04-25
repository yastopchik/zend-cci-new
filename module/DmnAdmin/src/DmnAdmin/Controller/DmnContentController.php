<?php 
namespace DmnAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel; 
use DmnAdmin\Service\DmncontentService;
use DmnAdmin\Form\TextForm;
use DmnAdmin\Form\TextFilter;

class DmnContentController extends AbstractActionController
{		
	protected $dbContent;
	
	public function __construct(DmncontentService $dbContent)
	{
		$this->dbContent = $dbContent;
	}
	public function indexAction()
	{ 	  
	   $view = new ViewModel();
	   $view->setTemplate('dmnadmin/dmncontent/index');
	   $id=$this->params()->fromRoute('id', 1);	   
	   $this->dbContent->setId($id);	
	   $data=$this->dbContent->getContentById();  	    	   
	   $request = $this->getRequest();
	   $form=new TextForm($data);
	   if ($request->isPost()) {           
		 $filter = new TextFilter();                                       
		 $form->setInputFilter($filter->getInputFilter());            
		 $form->setData($request->getPost());         
		 if ($form->isValid()) {                          
			 $dataform=$form->getData(); 
			 $this->dbContent->update($dataform);
			 return $this->redirect()->toRoute('dmncontent', array('action'=>'index', 'id'=>$id));   
		  }       
		}
	   $view->setVariable('id', $id);
	   $view->setVariable('data', $data);     
	   $view->setVariable('form', $form);  
	   $view->setVariable('static', $this->dbContent->getStatic());	   
	 return $view; 	 
	}
	
}
