<?php 
namespace DmnAdmin\Options;  

class XmlOptions implements XmlOptionsInterface
{
	/**
	 * @var array
	 */
	protected $requestNumberOptions = array(
			'options' => array(		
			             'forms'  =>'forms',
						 'stranapr'=>'destinationiso',
						 'datadoc'=>'dateorder',
					     'nomercert' =>'workorder',
					     'nblanka' =>'numblank',
					     'datacert'=> 'dateorder',
					     'expert'=> 'executor',
						 'flsezrez'=>'isresident',						 
						 'sez'=>'sezname',						 
			             'status'=>'status',
			             'flsez'=>'flsez',
			             'parentnumber'=>'parentnumber',
			             'parentnstatus'=>'parentnstatus',
			             'koldoplist'=>'numdoplist',			             
			),
	);
	
	/**
	 * @var array
	 */
	protected $requestOptions = array(
			'options' => array(					
					     'unn' =>'unpconsignor',
					 	 'kontrp' =>'consignor',
					     'kontrs'=> 'consignor',
					     'adress' =>'adressconsignor',
					  	 'poluchat'=> 'consignee',
					     'adresspol'=> 'adressconsignee',
					     'rukovod' =>'fioagent',
					     'transport' =>'transport',
					     'marshrut' =>'itinerary',
					     'otmetka' =>'servicemark',
					     'stranapr' =>'destinationiso',
					     'unnexp'=> 'unpexporter',
					     'expp' =>'exporter',
					     'expadress'=> 'adressexporter',
					     'importer'=> 'importer',
					     'adressimp' =>'adressimporter',						 
						 'exps'=>'exporter',
			             'flexp'=>'flexp',
			             'flimp'=>'flimp',
			),
	);
	/**
	 * @var array
	 */
	protected $requestDescriptionOptions = array(
			'options' => array(
					'products'=>array(						
						'row'=>array(
							'numerator'  =>'paragraph',
							'tovar'  =>'description',
							'kodtn'  =>'hscode',
							'vidup'  =>'seats',
							'kriter' => '',
							'ves'  =>'quantity',
							'schet' => 'invoce',
							'aktnomer'=>'',
							'aktdata'=>''						
					)	
				)
			),
	);	
	/**
	 * @var array
	 */
	protected $additionalValues = array(	
				'stranav'  =>'by',
	            'stranap'=>'',					
			
	);	
	
	/**
	 * get convertSeveralRequestValues
	 *
	 * @return array
	 */
	public function getConvertSeveralRequestValues()
	{
		return $this->convertSeveralRequestValues;
	}
	/**
	 * get requestNumberOptions
	 *
	 * @return array
	 */
	public function getRequestNumberOptions()
	{
		return $this->requestNumberOptions;
	}
	/**
	 * get requestOptions
	 *
	 * @return array
	 */
	public function getRequestOptions()
	{
		return $this->requestOptions;
	}
	/**
	 * get requestDescriptionOptions
	 *
	 * @return array
	 */
	public function getRequestDescriptionOptions()
	{
		return $this->requestDescriptionOptions;
	}
	/**
	 * get additionalValues
	 *
	 * @return array
	 */
	public function getAdditionalValues()
	{
		return $this->additionalValues;
	}
}
