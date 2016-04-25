<?php 
namespace DmnAdmin\Options;  

use Zend\Stdlib\AbstractOptions;
use \PHPExcel_Style_Alignment; 
use \PHPExcel_Style_Border;


class PrintOptionsA  extends AbstractOptions implements PrintOptionsInterface
{			
    /**
     * @var array
     */
    private $excelToPrintMainPrintOptions = array(
            'options' => array(
					'setMaxpixeles'=>'278',
                    'setMaxpixelesNextPages'=>'559',									
					'setDeviation'=>'15',
					'setMonitoredColumn'=>'description',
					'setDativeat'=>'the Republic of Belarus',
                    'setDativeatcity'=>'Mogilev,',
                    'setPunctcolumn'=>'hscode',
                    'setPassing'=>'invoce',
                    'setContinuation'=>"see continuation",
                    'setByOrder'=>" on behalf of",
			),           
    );
    /**
     * @var array
     */
    private $ratioParamsForColumn = array(
            'seats' => '9',
            'description' => '30',
            'quantity' => '11',
            'invoce' => '11',
    );
	/**
	 * @var array
	 */
	private $aSheetPrintOptions = array(
					'getProtection'=>array(
							'getParams'=>false,
							'options'=>array(
									'Sheet'=>true,
									'Sort'=>true,
									'InsertRows'=>true,
									'FormatCells'=>true
							)
					),			
					'getPageMargins'=>array(
							'getParams'=>false,
							'options'=>array(
									'Top'=>'0.393',
									'Bottom'=>'0.176',
									'Right'=>'0.3152',
									'Left'=>'0.708'									
							)	
					),					
					'getColumnDimension'=>array(
							'getParams'=>true,
							'options'=>array(
									'A'=>array('Width'=>'6.28'),
									'B'=>array('Width'=>'4.25'),
									'C'=>array('Width'=>'9.644'),
									'D'=>array('Width'=>'5.59'),
									'E'=>array('Width'=>'17.3876'),
									'F'=>array('Width'=>'1.622'),
									'G'=>array('Width'=>'9.677'),
									'H'=>array('Width'=>'2.967'),
									'I'=>array('Width'=>'10.34'),
									'J'=>array('Width'=>'2.919'),
									'K'=>array('Width'=>'9.125'),
									'L'=>array('Width'=>'12.33'),
							)
					),
					'getRowDimension'=>array(
							'getParams'=>true,
							'options'=>array(
									'1'=>array('RowHeight'=>'15'),
									'2'=>array('RowHeight'=>'75.29'),
									'3'=>array('RowHeight'=>'63.46'),
									'4'=>array('RowHeight'=>'148'),
									'5'=>array('RowHeight'=>'50.5')	
							)					
					),
					'mergeCells'=>array(
							'getParams'=>true,
							'options'=>array(
									'A1:H1'=>null,
									'I1:K1'=>null,									
									'K1:L1'=>null,
									'A2:F2'=>null,
									'G2:J2'=>null,
									'K2:L2'=>null,
									'G3:H3'=>null,
									'I3:L3'=>null,
									'G4:L4'=>null,
									'A3:F3'=>null,
									'A4:F4'=>null,
									'A5:L5'=>null,
							)
					),
	);
	/**
	 * @var array
	 */
	private $aSheetMergeCurrentOptions = array(	 
	        'options'=>array(
	            'cell'=>array('0'=>array('begin'=>'B', 'end'=>'C'),
	                          '1'=>array('begin'=>'D', 'end'=>'G'),
	                          '2'=>array('begin'=>'J', 'end'=>'K'),
	            ),
	            'top'=>array('0'=>array('begin'=>'A', 'end'=>'F'),
	                          '1'=>array('begin'=>'G', 'end'=>'K'),
	            ),
	            'bottom1'=>array('0'=>array('begin'=>'A', 'end'=>'F'),
	                             '1'=>array('begin'=>'G', 'end'=>'L'),
	            ),
	            'bottom2'=>array('0'=>array('begin'=>'A', 'end'=>'I'),
	                             '1'=>array('begin'=>'J', 'end'=>'L'),
	            ),
	            'bottom3'=>array('0'=>array('begin'=>'A', 'end'=>'C'),
	                             '1'=>array('begin'=>'D', 'end'=>'E'),
	                             '2'=>array('begin'=>'G', 'end'=>'I'),
	                             '3'=>array('begin'=>'J', 'end'=>'L'),
	            ),
	            'continuation'=>array('0'=>array('begin'=>'D', 'end'=>'G'),
	            ),
	        ),
	);
	/**
	 * @var array
	 */
	private $aSheetRowHeight = array(
	        'options'=>array(	                
	                'top1'=>'35',
	                'top2'=>'35',	                
	                'bottom1'=>'38.5',
	                'bottom11'=>'55.75',
	                'bottom2'=>'22',
	                'bottom3'=>'40.5'
	        ),
	);
	/**
	 * @var array
	 */
	private $topMainPrintOptions = array(
			'options' => array(
					'I1'=>'workorder',
					'K2'=>'numblank',					
					'A2'=>array(
							0=>'consignor',
							1=>'prefix',							
							2=>'adressconsignor', 
					        3=>'exporter',
					        4=>'adressexporter'							
					),
					'A3'=>array(
							0=>'consignee',
							1=>'adressconsignee',
					        2=>'importer',
					        3=>'adressimporter'
					),
					'A4'=>array(
							0=>'transport',
							1=>'itinerary',
					),
			        'G4'=>array(
			                0=>'servicemark',
			        )
					
			),
	);
	/**
	 * @var array
	 */
	private $topPrintOptions = array(
			0 =>array(
					'options' => array(
							'G'=>'workorder',
							'L'=>'numblank',
							)
					)
	);	
	/**
	 * @var array
	 */
	private $countryOptions = array(
			'options' => array(
					'I3'=>array(
							0=>'dativeat',
					),	
			),
	);	
	/**
	 * @var array
	 */
	private $bottomPrintOptions = array(			
			0 =>array(
				'options' => array(
					'A'=>array(
							0=>'fullnameen',
					),
					'G'=>array(
							0=>'dativeat',						
					)
				  )						
				),
			1 =>array(
				'options' => array(
				    'J'    =>'nameen',
				)),
			2 =>array(
				'options' => array(
					'A'=>'dativeatcity',
				    'D'=>'dateorder',
					'G'=>'dativeatcity',
				    'J'=>'dateorder',
				 )
			   ),			
	);	
	/**
	 * @var array
	*/
	private $contentPrintOptions = array(
			'options' => array(
					'row'=>6,
					'column'=>array(
						'paragraph' => 'A',
						'seats' => 'B',
						'description' => 'D',
					    'hscode' => 'I',
						'quantity' => 'J',
						'invoce' => 'L',
					)
			),
	);
	/**
	 * @var array
	 */
	private $punctuationPrintOptions = array(
			'options' => array(
									
					'F'=>array(
							'dative'=>", "							
					),
					'A'=>array(
							'fullname'=>", "														
					),
					'A2'=>array(
							'consignor'=>", ",
							'prefix'=>" ",
					),
					'A3'=>array(
							'consignee'=>", "							
					),
					'A4'=>array(
							'transport'=>", "
					)
			),
	);
	/**
	 * @var array
	 */
	private $styleList = array(
			'mainTop'=>array(
				  'A2' => array(					
						'font'=>array(
							'name' => 'Arial',
							'size' => 10,
						),
						'alignment' => array(
							'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_LEFT,
							'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
							'wrap'       => true
						),
							
			      ),
				  'I1' => array(
					'font'=>array(
							'name' => 'Arial',
							'size' => 12,
					),
					'alignment' => array(
							'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_LEFT,
							'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_TOP,
							'wrap'       => true
					),
				  ),
				 'K2' => array(
					'font'=>array(
							'name' => 'Arial',
							'size' => 12,
					),
					'alignment' => array(
							'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_TOP,
							'wrap'       => true
					),
				 ),				
				'A3' => array(
					'font'=>array(
							'name' => 'Arial',
							'size' => 10,
					),
					'alignment' => array(
							'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_LEFT,
							'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_TOP,
							'wrap'       => true
					),
				),
				'A4' => array(
					'font'=>array(
							'name' => 'Arial',
							'size' => 12,
					),
					'alignment' => array(
							'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_LEFT,
							'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
							'wrap'       => true
					),
				),
				'G4' => array(
				        'font'=>array(
				                'name' => 'Arial',
				                'size' => 12,
				        ),
				        'alignment' => array(
				                'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_LEFT,
				                'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
				                'wrap'       => true
				        ),
				),
				'I3' => array(
					'font'=>array(
							'name' => 'Arial',
							'size' => 12,
					),
					'alignment' => array(
							'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_TOP,
							'wrap'       => true
					),
				),
			),
			'top'=>array(
				'G' => array(
					'font'=>array(
							'name' => 'Arial',
							'size' => 12,
					),
					'alignment' => array(
							'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_RIGHT,
							'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_TOP,
							'wrap'       => true
					),
				),
				'L' => array(
					'font'=>array(
							'name' => 'Arial',
							'size' => 12,
					),
					'alignment' => array(
							'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_TOP,
							'wrap'       => true
					),
				),
			),
			'cell' => array(
			    'A' => array(
					'font'=>array(
							'name' => 'Arial',
							'size' => 12,
					),
					'alignment' => array(
							'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_TOP,
							'wrap'       => true
					),
				),
				'A' => array(
						'font'=>array(
								'name' => 'Arial',
								'size' => 12,
						),
						'alignment' => array(
								'horizontal' => \PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
								'vertical' => \PHPExcel_STYLE_ALIGNMENT::VERTICAL_TOP,
								'wrap'       => true
						),
				),
				'B' => array(
						'font'=>array(
								'name' => 'Arial',
								'size' => 12,
						),
						'alignment' => array(
								'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_LEFT,
								'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_TOP,
								'wrap'       => true
						),
				),				
				'D' => array(
						'font'=>array(
								'name' => 'Arial',
								'size' => 12,
						),
						'alignment' => array(
								'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_LEFT,
								'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_TOP,
								'wrap'       => true
						),
				),
				'I' => array(
						'font'=>array(
								'name' => 'Arial',
								'size' => 12,
						),
						'alignment' => array(
								'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
								'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_TOP,
								'wrap'       => true
						),
				),
				'J' => array(
						'font'=>array(
								'name' => 'Arial',
								'size' => 11.5,
						),
						'alignment' => array(
								'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_JUSTIFY,
								'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_TOP,
								'wrap'       => true
						),
				),
				'L' => array(
						'font'=>array(
								'name' => 'Arial',
								'size' => 11,
						),
						'alignment' => array(
								'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_LEFT,
								'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_TOP,
								'wrap'       => true
						),
				),
					
						
			),
			'bottom1' => array(
				'A'=>array(	
					'font'=>array(
							'name' => 'Arial',
							'size' => 12,
					),
					'alignment' => array(
							'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_JUSTIFY,
							'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_TOP,
							'wrap'       => true
					),
			    ),
			    'G'=>array(
			    		'font'=>array(
			    				'name' => 'Arial',
			    				'size' => 12,
			    		),
			    		'alignment' => array(
			    				'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
			    				'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_TOP,
			    				'wrap'       => true
			    		),
			    ),
			),
			'bottom2' => array(	
			    'J'=>array(
			        'font'=>array(
			                'name' => 'Arial',
			                'size' => 12,
			        ),
			        'alignment' => array(
			                'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_LEFT,
			                'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
			                'wrap'       => true
			        ),
			    ),
			),
			'bottom3' => array(
					'A'=>array(
							'font'=>array(
									'name' => 'Arial',
									'size' => 12,
							),
							'alignment' => array(
									'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_RIGHT,
									'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
									'wrap'       => true
							),
					),
					'D'=>array(
					        'font'=>array(
					                'name' => 'Arial',
					                'size' => 12,
					        ),
					        'alignment' => array(
					                'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_LEFT,
					                'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
					                'wrap'       => true
					        ),
					),
					'G'=>array(
							'font'=>array(
									'name' => 'Arial',
									'size' => 12,
							),
							'alignment' => array(
									'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_RIGHT,
									'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
									'wrap'       => true
							),
					),
					'J'=>array(
					        'font'=>array(
					                'name' => 'Arial',
					                'size' => 12,
					        ),
					        'alignment' => array(
					                'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_LEFT,
					                'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
					                'wrap'       => true
					        ),
					),
			),
			'end' => array(
			        'begin'=>'A',
			        'end'=>'L',
			        'row'=>array(
			                'borders' => array(
			                        'top'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			                ),
			        ),
			),
			'continuation' => array(
			        'D'=>array(
			                'font'=>array(
			                        'name' => 'Arial',
			                        'size' => 12,
			                ),
			                'alignment' => array(
			                        'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
			                        'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
			                        'wrap'       => true
			                ),
			        ),
			),
			
	);	
	/**
	 * getExcelToPrintMainPrintOptions
	 *
	 * @return array
	 */
	public function getExcelToPrintMainPrintOptions()
	{
	    return $this->excelToPrintMainPrintOptions;
	}
	
	/**
	 * get style for sign
	 * @param cell
	 * @return array
	 */
	
	public function getStyleBySign($sign){
	
		if(array_key_exists($sign, $this->styleList)){
			return $this->styleList[$sign];
		}else{
			return $this->styleList['cell'];
		}	
		
	}	
	/**
	 * set login punctuation print options
	 *
	 * @param string $loginRedirectRoute
	 * @return PrintOptions
	 */
	public function setPunctuationPrintOptions($punctuationPrintOptions)
	{
		$this->punctuationPrintOptions = $punctuationPrintOptions;
		return $this;
	}
	
	/**
	 * getPunctuationPrintOptions
	 *
	 * @return array
	 */
	public function getPunctuationPrintOptions()
	{
		return $this->punctuationPrintOptions;
	}
	
	/**
	 * set sheet options
	 * @param string $aSheetPrintOptions
	 * @return PrintOptions
	 */
	public function setaSheetPrintOptions($aSheetPrintOptions){
		
		return $this->aSheetPrintOptions=$aSheetPrintOptions;
		return $this;
	}	
	/**
	 * get sheet options
	 * 
	 * @return array
	 */
	public function getaSheetPrintOptions(){
		return $this->aSheetPrintOptions;
	}
	/**
	 * set organization executor options
	 *
	 * @param string $orgExecutorOptions
	 * @return PrintOptions
	 */
	public function setOrgExecutorOptions($orgExecutorOptions)
	{
		$this->orgExecutorOptions = $orgExecutorOptions;
		return $this;
	}
	/**
	 * getOrgExecutorOptions
	 *
	 * @return array
	 */
	public function getOrgExecutorOptions()
	{
		return $this->orgExecutorOptions;
	}
	/**
	 * set country options
	 *
	 * @param string $countryOptions
	 * @return PrintOptions
	 */
	public function setCountryOptions($countryOptions)
	{
		$this->countryOptions = $countryOptions;
		return $this;
	}
	/**
	 * getCountryOptions
	 *
	 * @return array
	 */
	public function getCountryOptions()
	{
		return $this->countryOptions;
	}
	/**
	 * set top Main
	 *
	 * @param string $topMainPrintOptions
	 * @return PrintOptions
	 */
	public function setTopMainPrintOptions($topMainPrintOptions)
	{
		$this->topMainPrintOptions = $topMainPrintOptions;
		return $this;
	}
	/**
	 * getTopMainPrintOptions
	 *
	 * @return array
	 */
	public function getTopMainPrintOptions()
	{
		return $this->topMainPrintOptions;
	}
	/**
	 * set top
	 *
	 * @param string $topPrintOptions
	 * @return PrintOptions
	 */
	public function setTopPrintOptions($topPrintOptions)
	{
		$this->topPrintOptions = $topPrintOptions;
		return $this;
	}
	/**
	 * getTopPrintOptions()
	 *
	 * @return array
	 */
	public function getTopPrintOptions()
	{
		return $this->topPrintOptions;
	}
	/**
	 * set Bottom	 
	 *
	 * @param string $getBottomPrintOptions
	 * @return PrintOptions
	 */
	public function setBottomPrintOptions($bottomPrintOptions)
	{
		$this->bottom1PrintOptions = $bottomPrintOptions;
		return $this;
	}
	/**
	 * getBottom1PrintOptions
	 *
	 * @return array
	 */
	public function getBottomPrintOptions(){
		
		return $this->bottomPrintOptions;
	}	
	/**
	 * set content
	 *
	 * @param string $contentPrintOptions
	 * @return PrintOptions
	 */
	public function setContentPrintOptions($contentPrintOptions)
	{
		$this->contentPrintOptions = $contentPrintOptions;
		return $this;
	}
	/**
	 * getContentPrintOptions
	 *
	 * @return array
	 */
	public function getContentPrintOptions(){
	
		return $this->contentPrintOptions;
	}	
	
	/**
	 * getRatioParamsForColumn
	 *
	 * @return array
	 */
	public function getRatioParamsForColumn(){
	
	    return $this->ratioParamsForColumn;
	}
	/**
	 * getaSheetMergeCurrentOptions
	 *
	 * @return array
	 */
	public function getaSheetMergeCurrentOptions(){
	
	    return $this->aSheetMergeCurrentOptions;
	}
	/**
	 * getaSheetRowHeight
	 *
	 * @return array
	 */
	public function getaSheetRowHeight(){
	
	    return $this->aSheetRowHeight;
	}
}