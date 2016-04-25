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
	protected $requestDescriptionOptions = array(
			'options' => array(
					'id'=>'ID',
					'paragraph'    => 'П/н №',
					'seats' => 'К-во мест и вид упак.',
					'description'    => 'Описание товара',
					'hscode'    => 'Код ТНВЭД',
					'quantity'    => 'Кол-во товара',
					'unit'    => 'Ед.изм.',
					'invoce'    => 'Номер и дата счета-фактуры',
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
}
