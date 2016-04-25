<?php 
namespace DmnAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use DmnAdmin\Service\DmnstatisticsService;
use Zend\View\Model\ViewModel; 

class DmnStatisticsController extends AbstractActionController
{
		
	protected $statisticsService;
	
	public function __construct(DmnstatisticsService $statisticsService)
	{
		$this->statisticsService = $statisticsService;
	}
	public function indexAction()
	{
		$view = new ViewModel();
		$view->setTemplate('dmnadmin/dmnstatistics/index');
		return $view;
	}
	public function fusionAction()
	{
		$this->statisticsService->setQueryParametrs($this->getRequest()->getQuery());

		$response=array(
			'chartContainerClients'=>$this->statisticsService->getCountOfRequestByClients(),
			'chartContainerForms'=>$this->statisticsService->getCountOfRequestByForms(),
			'chartContainerExecutors'=>$this->statisticsService->getCountOfRequestByExecutors(),
			'chartContainerStatus'=>$this->statisticsService->getCountOfRequestByStatus(),
			'chartContainerCountry'=>$this->statisticsService->getCountOfRequestByCountry()
		);

		return $this->getResponse()->setContent(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	}
	public function xlsAction()
	{
	    $response = $this->getResponse();
	    $response->getHeaders()->clearHeaders()->addHeaders(array(
	            'Pragma' => 'public',
	            'Content-Type' => 'application/vnd.ms-excel',
	            'Content-Disposition' => 'attachment;filename="Statistics.xls"',
	            'Cache-Control' => 'max-age=0'
	    ));
	    $this->statisticsService->setQueryParametrs($this->getRequest()->getQuery());   
	    $this->statisticsService->setFileName('Statistics');
	    ob_start();
	    $this->statisticsService->downloadXls();
	    $excelOutput = ob_get_clean();
	    $response->setContent($excelOutput);	  
	    return $response;	    
	}
	/*public function getformsAction(){	
	    
	    $this->statisticsService->setQueryParametrs($this->getRequest()->getQuery());
	    
	    $response=$this->statisticsService->getCountOfRequestByForms();
	
	    return $this->getResponse()->setContent(json_encode($response['data'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	    	
	}
	public function getclientsAction(){	    
	  
	    
	    $this->statisticsService->setQueryParametrs($this->getRequest()->getQuery());
	     
	    $response=$this->statisticsService->getCountOfRequestByClients();
	
	    return $this->getResponse()->setContent(json_encode($response['data'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	
	}
	public function getexecutorsAction(){
	    
	    $this->statisticsService->setQueryParametrs($this->getRequest()->getQuery());
	
	    $response=$this->statisticsService->getCountOfRequestByExecutors();
	
	    return $this->getResponse()->setContent(json_encode($response['data'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	
	}
	public function getstatusAction(){
	     
	    $this->statisticsService->setQueryParametrs($this->getRequest()->getQuery());
	
	    $response=$this->statisticsService->getCountOfRequestByStatus();
	
	    return $this->getResponse()->setContent(json_encode($response['data'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));	
	}
	public function getcountryAction(){
	
	    $this->statisticsService->setQueryParametrs($this->getRequest()->getQuery());
	
	    $response=$this->statisticsService->getCountOfRequestByCountry();
	
	    return $this->getResponse()->setContent(json_encode($response['data'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
	}*/
	  
}
