<?php 
namespace DmnAdmin\Options;  

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
			        'forms'=>'Форма сертификата',
			        'file'    => 'Файл',					
					'status'    => 'Статус',		
			        'numdoplist'    => 'КолДопЛист',
					'name'    => 'ФИО Заказчика',
					'position'    => 'Должность',
					'phone'    => 'Телефон',
					'organization'    => 'Организация',
					'executor'    => 'Исполнитель',
					'destinationiso'    => 'Страна Назначения',
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
	 * @var array
	 */
	protected $orgExecutorOptions = array(
			'options' => array(
					'id'=>'ID',
					'name'    => 'НазваниеОрганизации',			        
					'fullname'    => 'ПолноеНазвание',
			        'fullnameen'=>'ПолноеНазваниеАнглиск',
					'city'    => 'Город',
					'address' => 'Адрес',
			        'addressen' => 'АдресАнглиск',
					'phone'    => 'Телефон',
					'unp'    => 'УНП',
			),
	);
	/**
	 * @var array
	 */
	protected $executorOptions = array(
			'options' => array(
					'id'=>'ID',
					'login'    => 'Логин',					
					'email'    => 'Email',
					'executor'    => 'Полное Имя',
					'nameshort'    => 'Имя',
			        'nameshorten'=>'ИмяАнглиск.',
					'position'    => 'Должность',					
					'phone'    => 'Телефон',
					'activate' => 'Активация',
			        'roleId'=> 'Роль',
					'roleRus'=> 'Роль',
					'datelastvisit'    => 'Дата последнего визита',
			),
	);
	/**
	 * @var array
	 */
	protected $orgUserOptions = array(
			'options' => array(
					'id'=>'ID',
					'name'    => 'НазваниеОрганизации',
					'fullname'    => 'ПолноеНазвание',
					'city'    => 'Город',
					'address' => 'Адрес',
					'phone'    => 'Телефон',
					'unp'    => 'УНП',
					'contract'    => 'НомерДоговора',
					'datecontract'    => 'ДатаДоговора',
					'sezname'=>'СЭЗ'
			),
	);
	/**
	 * @var array
	 */
	protected $userOptions = array(
			'options' => array(
					'id'=>'ID',
					'login'    => 'Логин',					
					'email'    => 'Email',
					'executor'    => 'Имя Полное',
					'nameshort'    => 'Имя',
					'position'    => 'Должность',					
					'phone'    => 'Телефон',
					'activate' => 'Активация',					
					'datelastvisit'    => 'Дата последнего визита',
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
	 * get orgExecutorOptions
	 *
	 * @return string
	 */
	public function getOrgExecutorOptions()
	{
		return $this->orgExecutorOptions;
	}
	/**
	 * get orgUserOptions
	 *
	 * @return string
	 */
	public function getOrgUserOptions()
	{
		return $this->orgUserOptions;
	}
	/**
	 * get ExecutorOptions
	 *
	 * @return string
	 */
	public function getExecutorOptions()
	{
		return $this->executorOptions;
	}
	/**
	 * get orgUserOptions
	 *
	 * @return string
	 */
	public function getUserOptions()
	{
		return $this->userOptions;
	}
}
