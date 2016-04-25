<?php

namespace DmnAdmin\Service;

use DmnDatabase\Service\StatisticService;
use Zend\Stdlib\Parameters;
use \PHPExcel;
use \PHPExcel_STYLE_ALIGNMENT;
use \PHPExcel_STYLE_FILL;
use \PHPExcel_Style_Border;

class DmnstatisticsService {  
    /**
     *
     * @var $dbStatistic
     */
    protected $dbStatistic;
    
    /**
     *
     * @var $statistic
     */
    protected $statistic=array();    
    /**
	 *
	 * @var $authUserId
	 */
	protected $authUserId;
	/**
	 *
	 * @var $authRoleId
	 */
	protected $authRoleId;
	/**
	 *
	 * @var $fileName
	 */
	protected $fileName;
	/**
	 *Get $fileName
	 *@return fileName
	 */
	public function getFileName()
	{
	    return $this->fileName;
	}
	/**
	 *@param string $fileName
	 *@return $this
	 */
	public function setFileName($fileName)
	{
	    $this->fileName = $fileName;
	
	    return $this;
	}
    /**
     *
     * @param StatisticService $dbStatistic
     */
    public function setDbStatistic(StatisticService $dbStatistic){
         
        $this->dbStatistic = $dbStatistic;
    }
    /**
     *
     * @return $dbRequest
     */
    public function getDbRequest(){
    
        return $this->dbRequest;
    }
    /**
      * View Count of request by Forms
      * @return query
      */
    public function getCountOfRequestByForms(){  
        
        $this->dbStatistic->setAuth($this->authUserId);
        
        $this->dbStatistic->setRole($this->authRoleId);
        
        $data=$this->dbStatistic->getCountOfRequestByForms($this->statistic)->getResult();   
        
        $response['data']=array();
        
        if(is_array($data)){
                        
            foreach ($data as $key=>$value){
                $response['data'][]= $value;                
            }
        }        
        return $response;  
    }
    public function getCountOfRequestByClients(){  
        
        $this->dbStatistic->setAuth($this->authUserId);
        
        $this->dbStatistic->setRole($this->authRoleId);
        
        $data=$this->dbStatistic->getCountOfRequestByClients($this->statistic)->getResult();   
        
        $response['data']=array();
        
        if(is_array($data)){
                        
            foreach ($data as $key=>$value){
                $response['data'][]= $value;                
            }
        }
        
        return $response;  
    }
    public function getCountOfRequestByExecutors() {
        
        $this->dbStatistic->setAuth($this->authUserId);
        
        $this->dbStatistic->setRole($this->authRoleId);
    
        $data=$this->dbStatistic->getCountOfRequestByExecutors($this->statistic)->getResult();
    
        $response['data']=array();
    
        if(is_array($data)){
    
            foreach ($data as $key=>$value){
                $response['data'][]= $value;
            }
        }
    
        return $response;
    }
    public function getCountOfRequestByStatus() {
        
        $this->dbStatistic->setAuth($this->authUserId);
        
        $this->dbStatistic->setRole($this->authRoleId);
    
        $data=$this->dbStatistic->getCountOfRequestByStatus($this->statistic)->getResult();
    
        $response['data']=array();
    
        if(is_array($data)){
    
            foreach ($data as $key=>$value){
                $response['data'][]= $value;
            }
        }
    
        return $response;
    }
    public function getCountOfRequestByCountry(){
    
        $this->dbStatistic->setAuth($this->authUserId);
    
        $this->dbStatistic->setRole($this->authRoleId);
    
        $data=$this->dbStatistic->getCountOfRequestByCountry($this->statistic)->getResult();
    
        $response['data']=array();
    
        if(is_array($data)){
    
            foreach ($data as $key=>$value){
                $response['data'][]= $value;
            }
        }
        return $response;
    }
    /**
     *Downlod file request in xls format
     *@return outputXls
     */
    public function downloadXls()
    {
        $output=array(
	            'chartContainerClients'=>$this->getCountOfRequestByClients(),
	            'chartContainerForms'=>$this->getCountOfRequestByForms(),
	            'chartContainerExecutors'=>$this->getCountOfRequestByExecutors(),	
	            'chartContainerStatus'=>$this->getCountOfRequestByStatus(),
	            'chartContainerCountry'=>$this->getCountOfRequestByCountry()
	    );   
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);        
        $aSheet = $objPHPExcel->getActiveSheet();
        $aSheet->setTitle(substr($this->getFileName(), 0, -4));
        $aSheet->getPageSetup()->setFitToPage(true);
        $aSheet->getColumnDimension('A')->setWidth(50);        
        $row=1;
        $style = array(
                'font'=>array(
                        'name' => 'Arial',
                        'size' => 11,
                ),
                'alignment' => array(
                        'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_LEFT,
                        'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_TOP,
                        'wrap'       => true
                ),
                'fill' => array(
                        'type' => PHPExcel_STYLE_FILL::FILL_SOLID,
                        'color'=>array(
                                'rgb' => 'ccffcc'
                        )
                ),
                'borders' => array(
                        'allborders'=>array(
                                'style'=>PHPExcel_Style_Border::BORDER_THIN,
                        )
                )
        );
        if(is_array($output)) {
            foreach($output as $outputarray){
                foreach($outputarray as $responsearray){
                    foreach($responsearray as $response){  
                            $aSheet->getStyle('A'.$row)->applyFromArray($style);
                            $aSheet->setCellValue('A'.$row, stripslashes($response['label']));
                            $aSheet->getStyle('B'.$row)->applyFromArray($style);
                            $aSheet->setCellValue('B'.$row, stripslashes($response['value']));
                            $row++;                        
                    }
                    $aSheet->mergeCells('A'.$row.':'.'B'.$row);
                    $aSheet->setCellValue('A'.$row, '');
                    $row++;
                }  
            }
        } 
        $objWriter = new \PHPExcel_Writer_Excel5($objPHPExcel);
        $objWriter->save('php://output');
    }
    /**
     * Set Query parametrs into the varibles
     *@var Zend\Stdlib\Parameters parametrs
     */
    public function setQueryParametrs(Parameters $parametrs) {

        $date=$parametrs->get('period', date('Y-m-d'));
        $this->statistic['executors']=$parametrs->get('executors', 0);
        $this->statistic['forms']=$parametrs->get('forms', 0);
        $this->statistic['status']=$parametrs->get('status', 0);
        $this->statistic['organization']=$parametrs->get('organization', 0);
        $this->statistic['country']=$parametrs->get('country', 0);
        $this->statistic['periodDate']=explode(' ', (string) $date);  
        
    }
     /**
     *
     */
    public function getRole(){
    	 
    	return $this->authRoleId;
    }
    /**
     * set RoleId
     */
    public function setRole($authRole){
    	
    	$this->authRoleId=$authRole;
    }
    /**
     *
     */
    public function getAuth(){
    	
    	return $this->authUserId;
    }
    /**set UserId
     *    
     */
    public function setAuth($authUser){
    
    	$this->authUserId=$authUser;
    }
    
    
    
	

}

?>