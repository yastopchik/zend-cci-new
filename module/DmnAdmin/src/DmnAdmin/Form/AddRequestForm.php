<?php
namespace DmnAdmin\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;
use DmnDatabase\Service\RequestService;

class AddRequestForm extends Form
{    
    public function __construct(RequestService $db_request)
    {
        parent::__construct('AddRequest');  
        $this->setAttribute('method', 'post'); 
        $this->setHydrator(new ClassMethods(false));
        $this->setAttribute('enctype','multipart/form-data');        
        $this->add(array(
            'name' => 'consignor',
            'attributes' => array(
                'type'  => 'consignor', 
            ),
            'options' => array(
                'label' => '*Наименование организации грузоотправитель',
            ),
        )); 
        $this->add(array(
        		'name' => 'exporter',
        		'attributes' => array(
        				'type'  => 'exporter',
        		),
        		'options' => array(
        				'label' => 'Наименование организации экспортер (если отличается от отправителя)',
        		),
        ));
        $this->add(array(
        		'name' => 'consignee',
        		'attributes' => array(
        				'type'  => 'consignee',
        		),
        		'options' => array(
        				'label' => '*Наименование организации получателя',
        		),
        ));
        $this->add(array(
        		'name' => 'importer',
        		'attributes' => array(
        				'type'  => 'importer',
        		),
        		'options' => array(
        				'label' => 'Наименование организации импортер (если отличается от получателя)',
        		),
        ));
        $this->add(array(
        		'name' => 'transport',
        		'attributes' => array(
        				'type'  => 'transport',
        		),
        		'options' => array(
        				'label' => 'Средство транспорта',
        		),
        ));
        $this->add(array(
        		'name' => 'servicemark',
        		'attributes' => array(
        				'type'  => 'servicemark',
        		),
        		'options' => array(
        				'label' => 'Служебные отметки',
        		),
        ));
        $this->add(array(
        		'name' => 'adressconsignor',
        		'attributes' => array(
        				'type'  => 'adressconsignor',
        		),
        		'options' => array(
        				'label' => '*Адрес организации грузоотправитель',
        		),
        ));
        $this->add(array(
        		'name' => 'adressexporter',
        		'attributes' => array(
        				'type'  => 'adressexporter',
        		),
        		'options' => array(
        				'label' => 'Адрес организации экспортер (если отличается от отправителя)',
        		),
        ));
        $this->add(array(
        		'name' => 'adressconsignee',
        		'attributes' => array(
        				'type'  => 'adressconsignee',
        		),
        		'options' => array(
        				'label' => '*Адрес организации получателя',
        		),
        ));
        $this->add(array(
        		'name' => 'adressimporter',
        		'attributes' => array(
        				'type'  => 'adressimporter',
        		),
        		'options' => array(
        				'label' => 'Адрес организации импортер (если отличается от получателя)',
        		),
        ));
        $this->add(array(
        		'name' => 'itinerary',
        		'attributes' => array(
        				'type'  => 'itinerary',
        		),
        		'options' => array(
        				'label' => 'Маршрут следования',
        		),
        ));
        $this->add(array(
        		'name' => 'unpconsignor',
        		'attributes' => array(
        				'type'  => 'unpconsignor',
        		),
        		'options' => array(
        				'label' => '*УНП организации грузоотправитель',
        		),
        ));
        $this->add(array(
        		'name' => 'unpexporter',
        		'attributes' => array(
        				'type'  => 'unpexporter',
        		),
        		'options' => array(
        				'label' => 'УНП организации экспортер (если отличается от отправителя)',
        		),
        ));
        $this->add(array(
        		'name' => 'representation',
        		'attributes' => array(
        				'type'  => 'representation',
        		),
        		'options' => array(
        				'label' => '*Для предоставления в (наименование страны)',
        		),
        ));
        $this->add(array(
        		'name' => 'fioagent',
        		'attributes' => array(
        				'type'  => 'fioagent',
        		),
        		'options' => array(
        				'label' => '*ФИО Представителя',
        		),
        ));
               
         $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Добавить'
            ),
        ));   
    }   
}
