<?php 
namespace DmnAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel; 
use DmnAdmin\Service\DmncontentService;
use DmnAdmin\Form\TextForm;
use DmnAdmin\Form\WorkTimeForm;
use DmnAdmin\Form\TextFilter;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

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
		$data = $this->dbContent->getContent();
		//Отображаем полученные данные через panginator
		$adapter = new DoctrineAdapter(new ORMPaginator($data));
		$paginator = new Paginator($adapter);
		if($this->params()->fromRoute('page'))
			$page=$this->params()->fromRoute('page');
		$paginator->setCurrentPageNumber((int)$page)
			->setItemCountPerPage(20)
			->setPageRange(5);
		$view->setVariable('paginator', $paginator);
		$view->setVariable('page', $page);
		return $view;
	}
	public function editAction()
	{
		$view = new ViewModel();
		$view->setTemplate('dmnadmin/dmncontent/edit');
		$id = $this->params()->fromRoute('id', 1);
		$this->dbContent->setId($id);
		$data = $this->dbContent->getContentById();
		$request = $this->getRequest();
		$form = new TextForm($data);
		if ($request->isPost()) {
			$filter = new TextFilter();
			$form->setInputFilter($filter->getInputFilter());
			$form->setData($request->getPost());
			if ($form->isValid()) {
				$dataform = $form->getData();
				$this->dbContent->update($dataform);
				return $this->redirect()->toRoute('dmncontent', array('action' => 'index', 'id' => $id));
			}
		}
		$view->setVariable('id', $id);
		$view->setVariable('data', $data);
		$view->setVariable('form', $form);
		$view->setVariable('static', $this->dbContent->getStatic());
		return $view;
	}
	public function addAction()
	{

	}

	/*public function worktimeAction()
	{
		$auth=$this->dbContent->getAuth();
		if($auth == 2){
			$this->dbContent->setId(5);
			$data = $this->dbContent->getContentById();
			return $this->getResponse()->setContent(json_encode(['yes'=>$data], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		} else {
			return $this->getResponse()->setContent(json_encode(['no'=>true], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		}

	}*/
}
