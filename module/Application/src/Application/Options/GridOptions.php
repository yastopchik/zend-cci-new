<?php 
namespace Application\Options;  

class GridOptions  implements GridOptionsInterface
{
	/**
	 * @var array
	 */
	protected $requestNumberOptions = array(			
			'options' => array(
					'id'=>'ID',
					'workorder'    => 'Номер Заявки',
					'dateorder'    => 'Дата Заявки',
					'numblank'    => 'Номер Бланка',
			        'file'    => 'Файл',
					'status'    => 'Статус',
					'executor'    => 'Исполнитель',
					'execposition'    => 'Должность',
					'execphone'    => 'Телефон',
					'execemail'    => 'Email',
			),
	);
	/**
	 * @var array
	 */
	protected $requestOptions = array(
			'options' => array(					
					'consignor'    => '*Наименование организации грузоотправитель',
					'exporter' => 'Наименование организации экспортер (если отличается от отправителя)',
					'consignee'    => '*Наименование организации получателя',
					'importer'    => 'Наименование организации импортер (если отличается от получателя)',
					'transport'    => 'Средство транспорта',
					'servicemark'    => 'Служебные Отметки',
					'adressconsignor'    => '*Адрес организации грузоотправитель',
					'adressexporter'    => 'Адрес организации экспортер (если отличается от отправителя)',
					'adressconsignee'    => '*Адрес организации получателя',
					'adressimporter'    => 'Адрес организации импортер (если отличается от получателя)',
					'itinerary'    => 'Маршрут следования',
					'unpconsignor'    => '*УНП организации грузоотправитель',
					'unpexporter'    => 'УНП организации экспортер (если отличается от отправителя)',
					'representation'    => 'Для предоставления в (наименование страны)',
					'fioagent'    => '*ФИО Представителя',
			),
	);
	/**
	 * @var array
	 */
	protected $actOptions = array(
		'options' => array(
			'hscode' => 'Код ТН ВЭД',
			'description'    => 'Наименование',
			'criorigin'    => 'Критерий',
		),
	);
	/**
	 * @var array
	 */
	protected $actNumberOptions = array(
		'options' => array(
			'id'=>'ID',
			'numact'    => '№ Акта',
			'organization'    => 'Организация',
			'countryrule'    => 'Страна',
			'dateact'    => 'Дата Акта',
			'dateduration'    => 'Срок действия',
			'status'    => 'Статус',
		),
	);
	/**
	 * get requestNumberOptions
	 *
	 * @return string
	 */
	public function getRequestNumberOptions()
	{
		return $this->requestNumberOptions;
	}
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
	/**
	 * get ActOptions
	 *
	 * @return string
	 */
	public function getActOptions(){

		return $this->actOptions;

	}
	/**
	 * get ActOptions
	 *
	 * @return string
	 */
	public function getActNumberOptions(){

		return $this->actNumberOptions;

	}
}
