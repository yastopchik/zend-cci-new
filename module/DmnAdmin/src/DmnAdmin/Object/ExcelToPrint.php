<?php

namespace DmnAdmin\Object;

use PHPExcel;
use DmnAdmin\Options\PrintOptionsInterface;

/**
 * Class for generate Print in Excel Format
 */
class ExcelToPrint {

	private $aSheet;

	private $objPHPExcel;	

	private $request;
	
	private $requestContent;
	/**
	 * Current page
	 * 
	 * @var integer 
	 */
	private $page=1;
	/**
	 * Current row
	 *
	 * @var integer
	 */
	private $row;
	/**
	 * switch of pagese
	 *
	 * @var boolean
	 */
	private $switch=false;
	/**
	 * punctcolumn
	 *
	 * @var integer
	 */
	private $punctcolumn;
	/**
	 * dative at
	 *
	 * @var integer
	 */
	private $dativeat;
	/**
	 * dative at city
	 *
	 * @var integer
	 */
	private $dativeatcity;
	/**
	 * max pixels for column field
	 *
	 * @var integer
	 */	
	private $maxpixels;
	/**
	 * max pixels for column second and other pages
	 *
	 * @var integer
	 */
	private $maxpixelsNextPages;
	/**
	 * column is being monitored
	 *
	 * @var integer
	 */	
	private $monitoredColumn;	
	/**
	 * deviation in the number of characters
	 *
	 * @var integer
	 */	
	private $deviation;
	/**
	 * see continuation
	 *
	 * @var string
	 */
	private $continuation;
	/**
	 * PrintOptionsInterface $print
	 * 
	 * @var object
	 */
	private $print;
	/**
	 * sheetMethod
	 *
	 * @var object
	 */
	private $sheetMethod;
	/**
	 * sheetMethod
	 *
	 * @var object
	 */
	private $byorder;
	/**
	 * valueDesCount
	 *
	 * @var integer
	 */
	private $valueDesCount;
	/**
	 * currentKeyNum
	 *
	 * @var integer
	 */
	private $currentKeyNum=0;
	/**
	 * passing
	 *
	 * @var object
	 */
	private $passing;
	/**
	 * passingValue
	 *
	 * @var object
	 */
	private $passingValue;	
	
	/**
	 * set Request 
	 *
	 * @param string $request
	 * @return ExcelToPrint
	 */
	public function setRequest(array $request){
		
		$this->request = $request;		
		return $this;
	}
	/**
	 * get request
	 *	 
	 * @return array
	 */
	public function getRequest(){	
			
		return $this->request;
	}
	/**
	 * set RequestContent
	 *
	 * @param string $qequestContent
	 * @return ExcelToPrint
	 */
	public function setRequestContent(array $requestContent){
		
		$this->requestContent = $requestContent;
		//Необходимые элементы которых нет в БД
		if(!is_null($this->dativeat))
			$this->request['co'][0]['dativeat']=$this->dativeat;
		if(!is_null($this->dativeatcity))
		    $this->request['co'][0]['dativeatcity']=$this->dativeatcity;
		return $this;
	}
	/**
	 * get requestContent
	 *
	 * @return array
	 */
	public function getRequestContent(){
			
		return $this->requestContent;
	}		
	public function setPage($page) {
		
		$this->page = $page;		
	}
	public function setRow($row) {
	
		$this->row = $row;
	}
	public function setMaxpixeles($maxpixeles) {
		
		$this->maxpixels = $maxpixeles;
	}
	public function setMonitoredColumn($monitoredColumn) {
		
		$this->monitoredColumn = $monitoredColumn;
	}	
	public function setDeviation($deviation) {
		
		$this->deviation = $deviation;
	}
	public function setDativeat($dativeat) {
	
	    $this->dativeat = $dativeat;
	}
	public function setDativeatcity($dativeatcity) {
	
	    $this->dativeatcity = $dativeatcity;
	}
	public function setPassing($passing) {
	
		$this->passing = $passing;
	}
	public function setPassingValue($passingValue) {
	
	    $this->passingValue = $passingValue;
	}
	public function setPunctcolumn($punctcolumn) {
	
	    $this->punctcolumn = $punctcolumn;
	}
	public function setContinuation($continuation) {
	
	    $this->continuation = $continuation;
	}
	public function setMaxpixelesNextPages($maxpixelsNextPages) {
	
	    $this->maxpixelsNextPages=$maxpixelsNextPages;
	}
	public function setByorder($byorder) {
	
	    $this->byorder=$byorder;
	}	
	public function getRow() {
	
		return $this->row;
	}
	public function getPage() {
	
		return $this->page;
	}
	public function getMaxpixeles() {
	
		return $this->maxpixels;
	}	
	public function getMonitoredColumn() {
	
		return $this->monitoredColumn;
	}	
	public function getDeviation() {
	
		return $this->deviation;
	}
	public function getPassing(){
		
		return $this->passing;
	}
	public function getPassingValue(){
	
	    return $this->passingValue;
	}
	public function getDativeat() {
	
	    return $this->dativeat;
	}
	public function getDativeatcity() {
	
	    return $this->dativeatcity;
	}
	public function getPunctcolumn() {
	
	    return $this->punctcolumn;
	}
	public function getContinuation() {
	
	    return $this->continuation;
	}
	public function getMaxpixelesNextPages() {
	
	    return $this->maxpixelsNextPages;
	}
	public function getByorder() {
	
	    return $this->byorder;
	}
	/**
	 * set Excel Object and title
	 *
	 * @params PHPExcel $objPHPExcel, PrintOptionsInterface $printOptions, string $title
	 * @return ExcelToPrint
	 */
	function setExcelObject(PHPExcel $objPHPExcel, PrintOptionsInterface $printOptions, $title) {		
		
		$this->print=$printOptions;
		$objPageSetup = new \PHPExcel_Worksheet_PageSetup();
		$objPageSetup->setPaperSize(\PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
		$objPageSetup->setFitToPage(false);
		$this->objPHPExcel=$objPHPExcel;
		$this->objPHPExcel->setActiveSheetIndex(0);
		$this->aSheet = $this->objPHPExcel->getActiveSheet();
		$this->aSheet->setTitle($title);
		$this->aSheet->setPageSetup($objPageSetup);
		$this->setSheetOptions();
		$this->setExcelToPrintMainOptions();
		return $this;
	}
	/**
	 * Set a sheetOptions
	 *
	 * @throws Exception\RuntimeException
	 * @return void
	 */
	
	public function setSheetOptions(){
	    if (!$this->aSheet) {
	        throw new Exception\RuntimeException(sprintf('The aSheet isn\'t exist in setSheetMethod'));
	    }
	    foreach($this->print->getaSheetPrintOptions() as $getter=>$valueSheet){
	        if(array_key_exists('getParams', $valueSheet) && array_key_exists('options', $valueSheet)){
	            if (method_exists($this->aSheet, $getter)) {
	                foreach($valueSheet['options'] as $keyOpt=>$valueOpt){
	                    if($valueSheet['getParams']){
	                        if(is_array($valueOpt)){
	                            $this->sheetMethod=$this->aSheet->{$getter}($keyOpt);
	                            foreach($valueOpt as $key=>$value){
	                                $this->setSheetMethods($key, $value);
	                            }
	                        }else{
	                            $this->sheetMethod=$this->aSheet->{$getter}($keyOpt);
	                        }
	                    }else{
	                        $this->sheetMethod=$this->aSheet->{$getter}();
	                        $this->setSheetMethods($keyOpt, $valueOpt);
	                    }
	                }
	            }
	        }
	    }
	}
	/**
	 * Set a Excel To Print Main Options
	 *
	 * @throws Exception\RuntimeException
	 * @return void
	 */
	
	public function setExcelToPrintMainOptions(){			
		foreach($this->print->getExcelToPrintMainPrintOptions() as $valueOpt){
		    foreach($valueOpt as $keyOpt=>$valueOpt){
		        if (method_exists($this, $keyOpt)) {
		            $this->{$keyOpt}($valueOpt);
		        }
		    }
		}		
	}
	/**
	 * Set a sheetMethod
	 *	 
	 * @param string $key
	 * @param mixed $value	
	 * @throws Exception\RuntimeException
	 * @return void
	 */	
	public function setSheetMethods($key, $value)
	{
		if (!$this->sheetMethod) {
			throw new Exception\RuntimeException(sprintf('The sheetMethod isn\'t exist in setter'));			
		}		
		$setter = 'set' . $key;	
		if (method_exists($this->sheetMethod, $setter)) {
			$this->sheetMethod->{$setter}($value);	
			return;
		}
	}
	
	/**
	 * get Object for Response
	 *	 
	 * @return objPHPExcel
	 */
	public function getExcel() {
		if (!is_array($this->request) || !is_array($this->requestContent)) {
			throw new Exception\RuntimeException(sprintf('The variable(s) type isn\'t an array ', __CLASS__));
		}
		foreach ($this->requestContent as $keyDes=>$valueDes){
		  $this->valueDesCount=count($valueDes);
		  $this->currentKeyNum=0;		 
		  foreach ($valueDes as $keyNum=>$valueNum){		  	
		    $this->currentKeyNum++;
		    $this->fillContent($valueNum);	
			if($this->currentKeyNum==$this->valueDesCount){
			    $this->fillEnd();
			}
		  }
		}
		if($this->getMaxpixeles()>0){			
		$this->aSheet->getRowDimension($this->row)->setRowHeight($this->getMaxpixeles());
		}else{
		$this->aSheet->getRowDimension($this->row)->setRowHeight(1);
		}
		$this->fillBottom();
		return $this->objPHPExcel;

	}
	public function fillContent(array $valueNum){
		foreach ($this->print->getContentPrintOptions() as $options){
		 if(!isset($options['row']) || (!is_int(intval($options['row']))) || !is_array($options['column'])){
	         throw new Exception\RuntimeException(sprintf('The variable row isn\'t a integer or options isn\'t an array', __CLASS__));
		 }
		 if($this->page==1 && (!$this->switch)){
		     $this->fillMainTop(); 
		     $this->setRow($options['row']);
		     $this->switch=true;
		 }elseif($this->page!=1 && (!$this->switch)){
		     $valueNum[$this->passing]=$this->passingValue;
		     $this->switch=true;
		 }		 		 
		 //Merge cell	
		 $this->mergeCurrentRow('cell');		 
		 $heigthMonitoredColumn=ceil($this->calculateRowHeigth($valueNum));
		 $heigthCompares=$this->getMaxpixeles();
		 $compare=$heigthCompares-$heigthMonitoredColumn;		 
		 if($compare>=$this->getDeviation()){		     		 	
		         $this->fillRowContent($valueNum, $options['column']);		        
		         $this->setMaxpixeles($compare);
		         $this->aSheet->getRowDimension($this->row)->setRowHeight($heigthMonitoredColumn);		         
		         $this->setRow(++$this->row);			     	     
		 }else{
		     if(($this->currentKeyNum==$this->valueDesCount)&&(abs($compare)<=15)){
		         $this->fillRowContent($valueNum, $options['column']);
		         $this->setMaxpixeles(0);
		         $this->aSheet->getRowDimension($this->row)->setRowHeight($heigthMonitoredColumn-1);
		         $this->setRow(++$this->row);			         
		     }else{
		         $string=$this->divideString($valueNum);
		         if(count($string)==2){		             
		             //$string[0]['description']=$string[0]['description'].$this->continuation;
		             $this->fillRowContent($string[0], $options['column']);
		             $this->aSheet->getRowDimension($this->row)->setRowHeight($this->getMaxpixeles());
		             $this->transitionPage();
		             if(!is_null($string[1])){
		                 //$string[1][$this->passing]=$this->passingValue;
		                 //рекурсия
		                 $this->fillContent($string[1]);
		             }
		         }
		     }  
		 }		 		 
	    }
	}
	/**
	 * The transition from page to page	
	 * @return void
	 */
	public function transitionPage(){
	    $this->fillContinuation($this->continuation);	    
		$this->fillBottom();		
		$this->fillTop();
		$this->setRow(++$this->row);		
		$this->setMaxpixeles($this->maxpixelsNextPages);
		$this->setPage(++$this->page);
		$this->switch=false;		
	}	
	/**
	 * Fill continuation
	 * @param $continuation
	 * @return void
	 */
	public function fillContinuation($continuation=''){
	    $this->row++;	
	    $this->mergeCurrentRow('continuation');
	    $this->aSheet->setCellValue('D'.$this->row, $continuation);
	    $this->setStyle('D'.$this->row, 'continuation');
	}
	/**
	 * Fill 
	 * @param array $valueNum, integer $row 
	 * @return int
	 */
	public function fillRowContent(array $valueNum, $options){					
		foreach ($valueNum as $key=>$value){
			if(array_key_exists($key, $options)){				
				$this->setStyle($options[$key].$this->row, 'cell');
				/*if(!is_null($this->punctcolumn) && ($key==$this->punctcolumn) && (($value) && !empty($value)))				
				    $this->aSheet->setCellValue($options[$key].$this->row, stripslashes('«'.$value.'»'));
				else*/
				if(!is_null($this->passing) && ($key==$this->passing) && (($value) && !empty($value))){
				    $this->passingValue=$value;				    
				    $this->aSheet->setCellValue($options[$key].$this->row, stripslashes($value));
				}				
				else				
				    $this->aSheet->setCellValue($options[$key].$this->row, stripslashes($value));				
			}
		}
	}	
	/**
	 * Fill the Top of MainPage	 
	 */
	public function fillMainTop(){
		
		$this->fillTemplates($this->print->getTopMainPrintOptions(), 'mainTop');		
		//CountryOptions
		$this->fillTemplates($this->print->getCountryOptions(), 'mainTop');
	}
	/**
	 * Fill the Top of MainPage
	 */
	public function fillTop(){
		foreach($this->print->getTopPrintOptions() as $key=>$value){
			$this->row++;
			switch ($key){
				case '0':
				    $this->mergeCurrentRow('top');	
				    $this->setRowHeight('top1');					
					break;				
			}
			$this->fillTemplates($value, 'top', $this->row);
			$this->row++;
			$this->setRowHeight('top2');			
		}		
	}	
	/**
	 * Fill the Bottom of Page
	 */
	public function fillBottom(){
	    foreach($this->print->getBottomPrintOptions() as $key=>$value){
	        $this->row++;
	        switch ($key){
	            case '0':
	                $bottom='bottom1';	
	                $this->setRowHeight($bottom);	               
	                $this->row++;
	                $this->mergeCurrentRow($bottom);
	                $this->setRowHeight('bottom11');
	                break;
	            case '1':
	                $bottom='bottom2';
	                $this->mergeCurrentRow($bottom);
	                $this->setRowHeight($bottom);	             
	                break;
	            case '2':
	                $bottom='bottom3';
	                $this->mergeCurrentRow($bottom);
	                $this->setRowHeight($bottom);	                            
	                break;
	        }
	        $this->fillTemplates($value, $bottom, $this->row);
	    }
	    $this->aSheet->setBreak('A'.$this->row, \PHPExcel_Worksheet::BREAK_ROW );
	}
	/**
	 * Fill cell in the data by options and style (sign) 
	 * @params  array templatesOptions, string sign 
	 */
	protected function fillTemplates($templatesOptions, $sign, $row=null){

		foreach ($templatesOptions as $options){
			foreach ($options as $keys=>$value){
				if(is_null($row)){
					$key=$keys;				
		
				}else{
					$key=$keys.$row;					
				}
				$this->setStyle($key, $sign);
				if(!is_array($value)&&(!empty($value))){					
					foreach($this->request as $reqKey=>$reqValue){
						foreach($reqValue as $reqValueValue){
							$this->fillCellIfNotArray($value, $key, $reqValueValue);
						}
					}
				}elseif(is_array($value)){
					$str='';
					foreach($value as $keyAr=>$valueAr){						
						foreach($this->request as $reqKey=>$reqValue){
							foreach($reqValue as $reqValueValue){
								$str.=$this->fillCellIfArray($valueAr, $key, $reqValueValue);
							}
						}
					}
					if(substr(rtrim($str), - 1)==',')
						$str=substr(rtrim($str), 0, - 1);
					$this->aSheet->setCellValue($key, stripslashes($str));
				}				
			}
		}
	}	
	/**
	 * Fill END	
	 * @return void
	 */
	public function fillEnd(){
	    $this->fillContinuation();
	    $style=$this->print->getStyleBySign('end');	   
	    if(array_key_exists('begin', $style) && (array_key_exists('end', $style))){
	        $this->aSheet->getStyle($style['begin'].$this->row.':'.$style['end'].$this->row)->applyFromArray($style['row']);
	    }
	    
	}
	/**
	 * set to cell if options is not an array
	 * @params string $value, string $key, array request
	 */
	protected function fillCellIfNotArray($value, $key, array $request){
		if(array_key_exists($value, $request)){
			if($request[$value] instanceof \DateTime)
				$request[$value]=$request[$value]->format('d.m.Y');			
			$this->aSheet->setCellValue($key, stripslashes($request[$value]));
		}
	}
	/**
	 * set to cell if options is an array
	 * @params string $value, string $key, array request
	 */
	protected function fillCellIfArray($value, $key, array $request){
		if(array_key_exists($value, $request)){
			if($request[$value] instanceof \DateTime)
				$request[$value]=$request[$value]->format('d.m.Y');			
			if(!empty($request[$value]) && ($value=='importer' || $value=='exporter'))
			    $request[$value]=$this->byorder.' '.$request[$value].$this->getPunctuationMark($key, $value).' ';
			elseif(!empty($request[$value]) && $value!='importer' && $value!='exporter')
			    $request[$value]=$request[$value].$this->getPunctuationMark($key, $value).' ';
			return $request[$value];
		}
	}
	/**
	 * Merge Current Row
	 * @param $sign 
	 * @return void
	 */
	public function mergeCurrentRow($sign){
	    $mergeCurrentRow=$this->print->getaSheetMergeCurrentOptions();
	    foreach ($mergeCurrentRow as $valueOpt){
	        if(array_key_exists($sign, $valueOpt)){
	            foreach ($valueOpt[$sign] as $key=>$value){
	                $this->aSheet->mergeCells($value['begin'].$this->row.':'.$value['end'].$this->row);
	            }
	        }
	    }
	}
	/**
	 * Set Row Height
	 * @param $sign
	 * @return void
	 */
	public function setRowHeight($sign){
	    $rowHeight=$this->print->getaSheetRowHeight();
	    foreach ($rowHeight as $valueOpt){
	        if(array_key_exists($sign, $valueOpt)){
	            $this->aSheet->getRowDimension($this->row)->setRowHeight($valueOpt[$sign]);
	        }
	    }
	}
	/**
	 * Heigth of the row (in pixels)
	 * @param $row array||Null
	 * @param $comare integer
	 * @return int
	 */
	public function calculateRowHeigth($row, $comare=0){
	   $ratioParamsForColumn=$this->print->getRatioParamsForColumn();
	   if(is_array($row)){
	    foreach($row as $key=>$value){
		    if(array_key_exists($key, $ratioParamsForColumn)){			       	           
		        $length=$this->countHeigth($value, $ratioParamsForColumn[$key]);
		        if($length>$comare){
		            $comare=$length;
		            $this->setMonitoredColumn($key);
		            
		        }
		    }
		  }
	   }elseif(is_null($row) && ($comare!=0)){
	       
	      $comare=$comare*$ratioParamsForColumn[$this->monitoredColumn];
	   }
		return $comare;
	}
	public function countHeigth($string, $ratio){	   	    
	    $s=substr_count($string, "\n");
	    if($s==0)
	        $s=1;
	    $string = str_replace('~\R~u','', $string);
	    $string=explode(' ', trim($string));
	    $k=0;$r=1;
	    foreach ($string as $key=>$value){	        
	        if(!empty($value)){
	            $stringLength=iconv_strlen($value, 'UTF-8');
	            $k+=$stringLength;
	            if($r!=count($string))
	                $k++;
	            if($k>=$ratio){
	                $s++;	                
	                $k=$stringLength;
	            }
	        }
	        $r++;	        
	    } 
	    $length=($s*$this->getDeviation());	      
	    return $length;
	}
	/**
	 * divide the array by the desired number of characters
	 * @param
	 * @return array
	 */
	public function divideString($valueNum){	
	    $string=array();	
		$ratioParamsForColumn=$this->print->getRatioParamsForColumn();
		foreach ($valueNum as $key=>$value){   		    
		    if(array_key_exists($key, $ratioParamsForColumn)){
		        $need=round((($this->getMaxpixeles()/$this->getDeviation()*$ratioParamsForColumn[$key])), 0);		
		        $stringLength=iconv_strlen($value, 'UTF-8');
		        if($stringLength>=$need && $need>0){       
		            $string[0][$key]=trim(substr($value, 0, strrpos(substr($value, 0, $need), ' ')));
		            $string[1][$key]=trim(substr($value, strrpos(substr($value, 0, $need), ' ')));
		            if(empty($string[0][$key]) || empty($string[1][$key])){
		                $string[0][$key]=trim(substr($value, 0, $need));
		                $string[1][$key]=trim(substr($value, $need));
		            }
		        }else{
		            $string[0][$key]=$value;
		            $string[1][$key]='';
		        }
		    }else{
		        $string[0][$key]=$value;
		        $string[1][$key]='';
		    }
		}	
		$flag=null;
		foreach ($string[1] as $key=>$value){
		    if(!empty($value)){
		        $flag=true;
		    }
		}	
		if(!$flag)
		    $string[1]=null;
		return $string;
	}
	protected function getPunctuationMark($cell, $value){
		if(!is_null($this->print->getPunctuationPrintOptions())){
			foreach ($this->print->getPunctuationPrintOptions() as $key=>$valueOptions){
				if(array_key_exists($cell, $valueOptions)){
					if(array_key_exists($value, $valueOptions[$cell])){
						return $valueOptions[$cell][$value];
					}
				}
			}
		}
	}
	/**
	 * set style
	 * 
	 * @param string $cell, string $sign
	 */
	public function setStyle($cell, $sign){		
		
		$style=$this->print->getStyleBySign($sign);	
		$row=trim(preg_replace( "/\d/", '' , $cell));	
		if(array_key_exists($cell, $style))
			$this->aSheet->getStyle($cell)->applyFromArray($style[$cell]);
		elseif(array_key_exists($row, $style))
			$this->aSheet->getStyle($cell)->applyFromArray($style[$row]);
		
	}
	
	

}
