<?php 
namespace DmnAdmin\Options;  

class ExcelOptions  implements ExcelOptionsInterface
{
	/**
	 * @var array
	 */
	protected $requestOptions = array(
			'options' => array(					
					0    => 'A2',
					1 	 => 'C2',
					2    => 'D2',
					3    => 'E2',
					4    => 'F2',
					5    => 'G2',
					6    => 'A4',
					7    => 'C4',
					8    => 'D4',
					9    => 'E4',
					10    => 'F4',
					11    => 'A6',
					12    => 'C6',
					13    => 'D6',
					14    => 'E6',
			),
	);
	/**
	 * @var array
	 */
	protected $requestDescriptionOptions = array(
			'options' => array(
					'row'=>9,
					'column'=>array(
						0 => 'A',
						1 => 'B',
						2 => 'C',
						3 => 'D',
						4 => 'E',
						5 => 'F',
						6 => 'G',						
					)					
			),
	);
	/**
	 * get requestOptions
	 *
	 * @return string
	 */
	public function getRequestOptions()
	{
		return $this->requestOptions;
	}
	/**
	 * get requestDescriptionOptions
	 *
	 * @return string
	 */
	public function getRequestDescriptionOptions()
	{
		return $this->requestDescriptionOptions;
	}
	
}
