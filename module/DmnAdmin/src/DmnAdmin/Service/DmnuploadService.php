<?php

namespace DmnAdmin\Service;

use Zend\Cache\Storage\Adapter\Filesystem;
use Zend\Validator\File\Extension;
use Zend\ServiceManager\ServiceLocatorInterface;
use DmnAdmin\Options\ExcelOptionsInterface;
use DmnAdmin\Options\XmlOptionsInterface;
use DmnAdmin\Object\ExcelToPrint;
use DmnDatabase\Service\Exception\RuntimeException;
use DmnDatabase\Validator\NoObjectExistsJoin;
use DmnDatabase\Service\OrganizationService;
use DmnLog\Service\LogService;
use \PHPExcel;
use \PHPExcel_STYLE_ALIGNMENT;
use \PHPExcel_STYLE_FILL;
use \PHPExcel_Style_Border;

class DmnuploadService{      
	/**
	 *
	 * @var $id
	 */
	protected $id;	
	/**
	 *
	 * @var $directory
	 */	
	protected $directory;
	/**
	 *
	 * @var $cache
	 */
	protected $cache;	
	/**
	 *
	 * @var $fileName
	 */
	protected $fileName;	
	/**
	 *
	 * @var $excelOptions
	 */
	protected $excelOptions;
	/**
	 *
	 * @var $xmlOptions
	 */
	protected $xmlOptions;
	/**
	 *
	 * @var $authUserId
	 */
	protected $authUserId;
	/**
	 *
	 * @var $logger
	 */
	protected $logger;
	/**
	 *
	 * @var $printObject
	 */
	protected $printObject;
	/**
	 *
	 * @var $dbOrganization
	 */
	protected $dbOrganization;
	/**
	 *
	 * @var $requestService
	 */
	protected $requestService;	
	/**
	 * @var ServiceLocator
	 */
	protected $serviceLocator;
	/**
	
	 * @param Zend\Cache\Storage\Adapter\Filesystem $cache
	 */
	public function __construct(Filesystem $cache)
	{		
		$this->cache = $cache;
	}	
	/**
	 *@return cache
	 */
	public function getCache()
	{
		 
		return $this->cache;
	}
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
	 *Get Request Service
	 *@return requestServices
	 */
	public function getRequestService()
	{
		return $this->requestService;
	}
	/**
	 *Set request Service
	 *@return requestService
	 */
	public function setRequestService(DmnrequestService $requestService)
	{
		$this->requestService = $requestService;
	
		return $this;
	}
	/**
	 *Get Print Object
	 *@return printObject
	 */
	public function getPrintObject()
	{
		return $this->printObject;
	}
	/**
	 *Set print Object
	 *@return printObject
	 */
	public function setPrintObject(ExcelToPrint $printObject)
	{
		$this->printObject = $printObject;
	
		return $this;
	}
	/**
	 *Get excelOptions
	 *@return excelOptions
	 */
	public function getExcelOptions()
	{
		return $this->excelOptions;
	}
	/**
	 *Set xmlOptions
	 *@return xmlOptions
	 */
	public function setXmlOptions(XmlOptionsInterface $options)
	{
		$this->xmlOptions = $options;
	
		return $this;
	}
	/**
	 *Get xmlOptions
	 *@return xmlOptions
	 */
	public function getXmlOptions()
	{
		return $this->xmlOptions;
	}
	/**
	 *Set excelOptions
	 *@return excelOptions
	 */
	public function setExcelOptions(ExcelOptionsInterface $options)
	{
		$this->excelOptions = $options;
	
		return $this;
	}
	/**
	 *
	 * @return $id
	 */
	public function getId(){
	
		return $this->id;
	}
	/**
	 *
	 * @param integer $id
	 */
	public function setId($id){
	
		if (!is_int(intval($id))||is_null(intval($id))) {
			throw new RuntimeException(sprintf('Failed to set varible. It is not an integer or is null', __CLASS__));
		}
		$this->id = $id;
	}
	/**
	 *
	 * @param LogService $logger
	 */
	public function setLogger(LogService $logger){
	
		$this->logger = $logger->getLogger();
	}
	/**
	 *
	 * @return $Logger
	 */
	public function getLogger(){
	
		return $this->logger;
	}
	/**
	 *Get Directory
	 *@return directory
	 */
	public function getDirectory()
	{
		return $this->directory;
	}
	/**
	 *Set Directory
	 *@return directory
	 */
	public function setDirectory(array $config)
	{
		//$this->directory = $this->cache->getItem('upload_directory');
	
		if(is_null($this->directory)){
			 
			foreach($config as $key=>$value){
	
				if(strcmp($key, 'directory')==0){
	
					$this->directory=$value['upload'];
					//$this->cache->setItem('upload_directory', $value['upload']);
				}
			}
		}
	
		return $this;
	}
	/**
	 *
	 */
	public function getAuth(){
	
		return $this->authUserId;
	}
	/**
	 *
	 */
	public function setAuth($authUserId){
		 
		$this->authUserId = $authUserId;
	}
	/**
	 *
	 * @param OrganizationService $dbOrganization
	 */
	public function setDbOrganization(OrganizationService $dbOrganization){
	
		$this->dbOrganization = $dbOrganization;
	}
	/**
	 *
	 * @return $Organization
	 */
	public function getDbOrganization(){
	
		return $this->dbOrganization;
	}
	/**
	 * Retrieve service locator instance
	 *
	 * @return ServiceLocator
	 */
	public function getServiceLocator()
	{
		return $this->serviceLocator;
	}
	
	/**
	 * Set service locator instance
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return User
	 */
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
	{
		$this->serviceLocator = $serviceLocator;
		return $this;
	}
	
	/**
	 *Upload File To Database
	 *@return true|false
	 */
	public function uploadFileToDatabase($save=false)
	{
		if(!is_null($this->fileName)){			
			$path=$this->getDirectory().'/'.$this->getFileName();			
			$this->logger->info('Загрузка заявки: пользователь -'.$this->authUserId.', файл -'.$path);				
			//Get Data From Excel 			
			$objReader = \PHPExcel_IOFactory::createReaderForFile($path);	
			$objReader->setReadDataOnly(true);
			$objPHPExcel = $objReader->load($path);
			$objWorksheet = $objPHPExcel->getActiveSheet();
			$worksheetTitle     = $objWorksheet->getTitle();
			$highestRow = $objWorksheet->getHighestRow();
			$highestColumn = $objWorksheet->getHighestColumn();
			$highestColumnIndex =\PHPExcel_Cell::columnIndexFromString($highestColumn);
			if($highestColumnIndex==7){
			    $data=array();			
			    //Number
			    if(!is_null($this->id)){
     			    $userId=intval($this->id);
     			    $executorId=$this->authUserId;
     		    }else{
     			    $userId=$this->authUserId;
     			    $executorId=$this->requestService->getDbUser()->getDistributorsByUserId($this->authUserId);
     		    }     		  
			    $data['rn']=array('rows'=>array(0=>array('id'=>'0', 'cell'=>array(4=>$this->getFileName(), 7=>$userId, 9=>$executorId))));
			    //Request
			    if(!is_null($this->getExcelOptions()->getRequestOptions())){
				    $data['rq']['rows'][0]['id']=0;
				    $data['rq']['rows'][0]['cell']=array();
				  foreach($this->getExcelOptions()->getRequestOptions() as $options){
					foreach ($options as $key=>$value){
						array_push($data['rq']['rows'][0]['cell'], $objWorksheet->getCell($value)->getValue());						
					}
				  }				
			    }
			    //Description
			    $requestDescriptionOptions=$this->getExcelOptions()->getRequestDescriptionOptions();
			    if(!is_null($requestDescriptionOptions)){				
				 $row=$requestDescriptionOptions['options']['row'];
				  while($row <= $highestRow){
					$keysRd=$row-$requestDescriptionOptions['options']['row'];
					$data['rd']['rows'][$keysRd]['id']=$keysRd;
					$data['rd']['rows'][$keysRd]['cell']=array();
					array_push($data['rd']['rows'][$keysRd]['cell'], '');
					$cols=$highestColumnIndex-1;				
					$column=0;	
					$break=0;					
					while ($column<=$cols){
						$cell=$objWorksheet->getCellByColumnAndRow($column, $row)->getValue();
						if(($column==2)&&(empty($cell))){
							foreach($requestDescriptionOptions['options']['column'] as $key=>$value){
								$cells=$objWorksheet->getCellByColumnAndRow($key, $row)->getValue();
								if(empty($cells)){
									$break++;
								}
								if($break==7){	
									unset($data['rd']['rows'][$keysRd]);
									$save=$this->requestService->getDbRequest()->saveRequest($data);
									$this->logger->info('Загрузка успешна: пользователь -'.$this->authUserId);
									return $save;
								}																	
							}							
						}
						array_push($data['rd']['rows'][$keysRd]['cell'], $objWorksheet->getCellByColumnAndRow($column, $row)->getValue());
						$column++;
					}
					$row++;
				}
			   }
			   //save	
			  $save=$this->requestService->getDbRequest()->saveRequest($data);
			  if($save)
			      $save=array('error'=>false);
			  else{
			      $save=array('error'=>'Ошибка при загрузке данных! Попробуйте еще раз.');
			  }
			}else{
			    $save=array('error'=>'Не верный формат файла xls файла!');
			}
			$this->logger->info('Загрузка успешна: пользователь -'.$this->authUserId);
		}	
		return $save;	
	}	
	/**
	 *Downlod file request in xls format
	 *@return outputXls
	 */
	public function downloadXls()
	{		
		$objPHPExcel = $this->cache->getItem('objPHPExcelXls');
		if(!is_file($this->getDirectory().'/'.$this->getFileName())){			
			copy(getcwd().'/public/'.$this->getFileName(), $this->getDirectory().'/'.$this->getFileName());
		}
		if(is_null($objPHPExcel)){
			$objPHPExcel = \PHPExcel_IOFactory::load($this->getDirectory().'/'.$this->getFileName());
			$this->cache->setItem('objPHPExcelXls', $objPHPExcel);
		}		
		$objPHPExcel->setActiveSheetIndex(0);
		$aSheet = $objPHPExcel->getActiveSheet();
		$aSheet->setTitle(substr($this->getFileName(), 0, -4));
		$aSheet->getPageSetup()->setFitToPage(true);		
		$requestOptions=$this->getExcelOptions()->getRequestOptions();		
		$request=$this->requestService->getDbRequest()->getRequestByRequestId($this->id)->getArrayResult();
		if(!empty($requestOptions) && !empty($request)){
			foreach($request as $requestId){
				$k=-2;
				foreach($requestId as $key=>$value){					
					if($k>=0){
						$aSheet->setCellValue($requestOptions['options'][$k], stripslashes($value));
					}
					$k++;
				}
			}
		}
		$requestDescriptionOptions=$this->getExcelOptions()->getRequestDescriptionOptions();
		$requestDescription=$this->requestService->getDbRequest()->getRequestDescriptionByRequestId($this->id)->getArrayResult();
		if(!empty($requestDescriptionOptions) && !empty($requestDescription)){
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
			$row=$requestDescriptionOptions['options']['row']+1;			
			foreach($requestDescription as $requestDescriptionId){
				$k=-2;
				$aSheet->getRowDimension($row)->setRowHeight(-1);
				foreach($requestDescriptionId as $key=>$value){											
					if($k>=0){						
						$aSheet->getStyle($requestDescriptionOptions['options']['column'][$k].$row)->applyFromArray($style);
						$aSheet->setCellValue($requestDescriptionOptions['options']['column'][$k].$row, stripslashes($value));
					}
					$k++;					
				}
				$row++;	
			}
		}		
		$objWriter = new \PHPExcel_Writer_Excel5($objPHPExcel);			
		$objWriter->save('php://output');		
	}	
	/**
	 *Downlod file request in xls format
	 *@return outputXls
	 */
	public function downloadPrint()
	{
		//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		//$this->authUserId=6;
		//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		$objPHPExcel = $this->cache->getItem('objPHPExcelPrint');		
		if(is_null($objPHPExcel)){			
			$objPHPExcel = new PHPExcel();
			$this->cache->setItem('objPHPExcelPrint', $objPHPExcel);
		}
		$rn=$this->convertRequestNumberToNeeds($this->requestService->getDbRequest()->getRequestNumberById($this->id)->getArrayResult(), true);
		if(!empty($rn)){
			foreach ($rn as $rnId){				
				$this->printObject->setExcelObject($objPHPExcel, $this->getPrintOptionsByFormsId($rnId['formsid']), $this->getFileName());				
				$co=$this->requestService->getDbCountry()->getCountryById($rnId['destinationiso'])->getArrayResult();
				break;
			}
		}
		unset($rnId);
		//send data to ExcelToPrint
		$this->printObject->setRequest(array_merge(
				array('rn'=>$rn), 
				array('rq'=>$this->requestService->getDbRequest()->getRequestByRequestId($this->id)->getArrayResult()), 				
				array('org'=>$this->dbOrganization->getOrgByUserId($this->authUserId)->getArrayResult()),
				array('co'=>$co)));	
		unset($rn);unset($co);	
		$this->printObject->setRequestContent(array('rd'=>$this->requestService->getDbRequest()->getRequestDescriptionByRequestId($this->id)->getArrayResult()));
		//get object for output
		$objPHPExcel=$this->printObject->getExcel();		
		$objWriter = new \PHPExcel_Writer_Excel5($objPHPExcel);
		$objWriter->save('php://output');
	}
	/**
	 *Get PrintOptions
	 *@return options
	 */
	public function getPrintOptionsByFormsId($formsid)
	{		
		$printOptions=null;
		if(!is_null($formsid)){
			switch ($formsid) {
				case 1:	$printOptions=$this->getServiceLocator()->get('print_options_ct1'); $this->setFileName('maket_ct1'); break;
				case 2:	$printOptions=$this->getServiceLocator()->get('print_options_ct2ru'); $this->setFileName('maket_ct2ru'); break;
				case 3:	$printOptions=$this->getServiceLocator()->get('print_options_generalen'); $this->setFileName('maket_generalen'); break;
				case 4:	$printOptions=$this->getServiceLocator()->get('print_options_generalru'); $this->setFileName('maket_generalru'); break;
				case 5:	$printOptions=$this->getServiceLocator()->get('print_options_a'); $this->setFileName('maket_a'); break;
				case 6:	$printOptions=$this->getServiceLocator()->get('print_options_ct2en'); $this->setFileName('maket_ct2en'); break;
			}
		}
		return $printOptions;
	}
	/**
	 *Downlod file request in xml format
	 *@return outputXml
	 */
	public function downloadXml()
	{		
	    $rn=$this->convertRequestForXml($this->convertRequestNumberToNeeds($this->requestService->getDbRequest()->getRequestNumberById($this->id)->getArrayResult()), $this->getXmlOptions()->getRequestNumberOptions());
		$rq=$this->convertRequestForXml($this->convertRequestToNeeds($this->requestService->getDbRequest()->getRequestByRequestId($this->id)->getArrayResult()), $this->getXmlOptions()->getRequestOptions());		
		$rd=$this->convertRequestForXml($this->requestService->getDbRequest()->getRequestDescriptionByRequestId($this->id)->getArrayResult(), $this->getXmlOptions()->getRequestDescriptionOptions(), true);
		$additional=$this->getXmlOptions()->getAdditionalValues();
		$xml=array_merge($additional, $rq, $rn, $rd);
		return $xml;		
	}
	/**
	 *Get List of RequestsNumber by Data
	 *@param DateTime date
	 *@return array||Null
	 */
	public function getRequestNumbersByDate(\DateTime $date)
	{
	    $this->requestService->setDate($date);
	    return $this->requestService->getRequestNumbersByDate();
	}
	/**
	 *Get List of Requests Number by Status
	 *@param DateTime date
	 *@return array||Null
	 */
	public function getRequestNumbersByStatus()
	{	    
	    return $this->requestService->getDbRequest()->getRequestNumbersByStatus()->getArrayResult();
	}
	/**
	 *Get FileName By Id
	 *@return string
	 */
	public function getFileNameById()
	{
		if (empty($this->id)) {
			throw new \InvalidArgumentException('XML id can\'t be empty');
		}
		return $this->requestService->getDbRequest()->getRequsetWorkOrder($this->id)->getSingleResult();
	}
	/**
	 * Convert Request to Need Format
	 *@params Array $request
	 *@return array
	 */
	protected function convertRequestToNeeds(array $request){
	    foreach($request as $keyId=>$valueId){
	        $request[$keyId]['flimp']=0;
	        $request[$keyId]['flexp']=0;	        
	        if(array_key_exists('exporter', $valueId)){
	          if(!empty($valueId['exporter']))
	                $request[$keyId]['flexp']=1;
	        }
	        if(array_key_exists('importer', $valueId)){
	          if(!empty($valueId['importer']))
	                $request[$keyId]['flimp']=1;
	        }
	    }
	    return $request;
	}
	/**
	 * Convert Request Number to Need Format
	 *@params Array $request, $print false|TRue
	 *@return array
	 */
	protected function convertRequestNumberToNeeds(array $request, $print=false){   	   
	    foreach($request as $keyId=>$valueId){
	      if(!$print){ 
	        $request[$keyId]['flsez']=0;
	        $request[$keyId]['parentnstatus']='';
	        $request[$keyId]['parentnumber']='';
	        //$request[$keyId]['koldoplist']=0;
	        if(array_key_exists('isresident', $valueId)){ 
	           if($valueId['isresident']<=1){
	                 $request[$keyId]['isresident']=0;	                 
	           }else{
	                 $request[$keyId]['isresident']=1;
	                 if(array_key_exists('workorder', $valueId)){
	                    if(substr($valueId['workorder'], 0, 4)=='BYBY'){
	                        $request[$keyId]['flsez']=1;
	        }}}}
	        if(array_key_exists('statusid', $valueId) && (!is_null($valueId['statusid']))){
	               $request[$keyId]['parentnstatus']=$valueId['status'];
	               if(($valueId['statusid']==5) && ($valueId['statusid']==6)){
	                   //Изменить на замену
	                   $request[$keyId]['parentnumber']==$valueId['workorder'];
	        }}	         
	        if(array_key_exists('destinationiso', $valueId) && (!is_null($valueId['destinationiso']))){
	              $country=$this->requestService->getDbRequest()->getCountryById($valueId['destinationiso']);
	              if(is_array($country)){
	                  foreach($country as $keyId=>$valueId){
	                      if(array_key_exists('iso', $valueId) && (!is_null($valueId['iso']))){
	                          $request[$keyId]['destinationiso']=$valueId['iso'];
	        }}}}
	      }else{
	          if(array_key_exists('workorder', $valueId)){
	              if(substr($valueId['workorder'], 0, 4)!='BYBY'){
	                  $request[$keyId]['sezname']='';
	                  $request[$keyId]['prefix']='';
	         }} 
	      }	          
	   }	        
	   return $request;	   
	}
	/**
	 *@params Array $request, Array $requestOptions, if description $desc true||false
	 *@return array
	 */
	protected function convertRequestForXml(array $request, array $requestOptions, $desc=false){
		
		if(!empty($requestOptions) && !empty($request)){
		  if(!$desc){
		   foreach($request as $requestId){
			foreach($requestOptions as $requestOptionsId){
				foreach($requestOptionsId as $key=>$value){
					if(array_key_exists($value, $requestId)){
						if(isset($requestId[$value]) && ($requestId[$value] instanceof \DateTime)){
							$requestId[$value]=$requestId[$value]->format('d.m.y');
						}
						if(!empty($value)){							    
							$xml[$key]=str_replace(array("\r","\n"),"", trim($requestId[$value]));
						}
						else
						$xml[$key]=$value;
					}}}}
		   }else{		   	
		   	foreach($requestOptions as $requestOptionsId){
		   		foreach($requestOptionsId as $keyPr=>$valuePr){		   			
		   			foreach($request as $reqKey=>$requestId){
		   				foreach($valuePr as $keyR=>$valueR){	
		   				   foreach($valueR as $key=>$value){		   				  
		   				 	if(array_key_exists($value, $requestId)||empty($value)){
		   						if(isset($requestId[$value]) && ($requestId[$value] instanceof \DateTime)){
		   							$requestId[$value]=$requestId[$value]->format('d.m.y');
		   						}		   						
		   						if(!empty($value)){
		   							$xml[$keyPr][$reqKey][$keyR][$key]=str_replace(array("\r","\n"),"", trim($requestId[$value]));
		   						}
		   						else
		   						$xml[$keyPr][$reqKey][$keyR][$key]=$value;		   							
		   				 	}}}}}}
		   }
		   return $xml;
		}
	}
	/**
	 *Delete file From directory
	 */
	public function deleteFileFromDirectory(){
		 
		$this->logger->info('Удаление файла в директории  -'.$this->authUserId.', файл -'.$this->getFileName());
		$path=$path=$this->getDirectory().'/'.$this->getFileName();
		$op_dir=opendir($this->getDirectory());
		if($op_dir){
			if (is_file($path))
			{
				unlink($path);
			}
	
		}
		closedir($op_dir);
	}
	
	////////////////////////GET SET Methods//////////////////////////////////////////////////////////////
   
    /**
     *@param array $data, string $fileName
     *@return adapter
     */
    public function getAdapter(array $data)
    {
    	if(!is_null($this->fileName)){
    	
    		$adapter = new \Zend\File\Transfer\Adapter\Http();
    	
	  		$size = new \Zend\Validator\File\Size(array('max'=>1000000));
	  		//Number
	  		if(!is_null($this->id))
	  		    $userId=intval($this->id);
	  		else
	  		    $userId=$this->authUserId;	  		    
	  		
	  		$fileExist= new NoObjectExistsJoin(array('object_repository'=>$this->requestService->getDbRequest()->getEntityManager()->getRepository($this->requestService->getDbRequest()->getEntityNameRequestNumber()), 
	  																	'fields' => 'i.file',
	  																	'exclude'=> array('j.id'=>$userId),
	  																	'join'=>$this->requestService->getDbRequest()->getEntityUser(),
	  																	'on'=>'i.userid',
	  																	'messages' => array( NoObjectExistsJoin::ERROR_OBJECT_FOUND => "У клиента в Базе Данных уже присутствует файл с таким именем! Если это не ошибка, переименуйте его.")
	  		));
	  	
	  		$extension = new Extension(array('extension' => array('xls', 'xlsx'),
	  			
	  			'messages' => array( Extension::FALSE_EXTENSION => "Файл не имеет расширение 'xls', 'xlsx'" )));
	  	
	  	
	  		$adapter->setValidators(array($size, $extension, $fileExist), $this->fileName);
	  		
    	}else{
    		
	  	return null;	  	
    	}	  	
	  	return $adapter;
    }  
    public function delTree($dir)
    {
        $files = array_diff(scandir($dir), array('.', '..'));
    
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
        }
    
        return rmdir($dir);
    }
       
}




?>