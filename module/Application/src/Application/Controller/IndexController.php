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
    	if($this->getRequest()->isXmlHttpRequest()) {
		    $forward=$this->forward()->dispatch(static::CONTROLLER_NAME, array('action' => 'authenticate'));
			return $this->getResponse()->setContent(json_encode($forward->getVariables(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		} else {
		    return $this->forward()->dispatch(static::CONTROLLER_NAME, array('action' => 'login'));   
		}
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
