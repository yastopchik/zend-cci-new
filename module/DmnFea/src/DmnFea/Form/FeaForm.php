<?php
namespace DmnFea\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;   
use Zend\Form\Element;

class FeaForm extends Form
{    
    public function __construct($title='')
    {
        parent::__construct('fea');  
        $this->setAttribute('method', 'post'); 
        $this->setHydrator(new ClassMethods(false));
        $this->setAttribute('enctype','multipart/form-data');  
        $this->add(array(
            'name' => 'request',
            'type'    => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Мероприятие*',
             ),            
            'attributes' => array(
                'required' => true,  
                'value'    =>trim($title)          
            )
        )); 
		$this->add(array(
                'name' => 'dateBegin',
                'attributes' => array(
                        'type'  => 'date',
                        'id'=>'dateBegin',
                        'required' => true,
                ),
                'options' => array(
                        'label' => 'Дата начала',
                ),
        ));
		$this->add(array(
                'name' => 'dateEnd',
                'attributes' => array(
                        'type'  => 'date',
                        'id'=>'dateEnd',
                        'required' => true,
                ),
                'options' => array(
                        'label' => 'Дата окончания',
                ),
        ));
		$this->add(array(
            'name' => 'organization',
            'type'    => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Наименование Организации*',
             ),            
            'attributes' => array(
                'required' => true,                
            )
        ));
		$this->add(array(
		        'name' => 'unp',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'УНП*',
		        ),
		        'attributes' => array(
		                'required' => true,
		        )
		));		
		
		$this->add(array(
		        'name' => 'phone',
		        'required' => true,
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'Контактный телефон*',
		        ),
		        'attributes' => array(
		                'required' => true,
		                'placeholder' => '375222778034',
		        )
		));		
		$this->add(array(
            'name' => 'email',
            'type'    => 'Zend\Form\Element\Email',
            'options' => array(
                'label' => 'Адрес электронной почты*',
             ),            
            'attributes' => array(
                'required' => true,   
                'placeholder' => 'example@gmail.com',
            )
        ));	
		$this->add(array(
		        'name' => 'fio',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'ФИО руководителя, должность*',
		        ),
		        'attributes' => array(
		                'required' => true,
		                'placeholder' => 'Иванов И.И., директор',
		        )
		));
		$this->add(array(
		        'name' => 'rule',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'Действует на основании',
		        ),
		        'attributes' => array(
		                'required' => false,
		                'placeholder' => 'Устава',
		        )
		));
		$this->add(array(
		        'name' => 'bank',
		        'type'    => 'Zend\Form\Element\Textarea',
		        'options' => array(
		                'label' => 'Банковские реквизиты',
		        ),
		        'attributes' => array(
		                'required' => false,
		                'placeholder' => 'р/с, название и адрес банка',
		        )
		));
		$this->add(array(
		        'name' => 'place',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'Размер торговой палатки, м2',
		        ),
		        'attributes' => array(
		                'required' => false,
		                'placeholder' => '9',
		        )
		));
		$this->add(array(
		        'name' => 'mphone',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'Мобильный телефон',
		        ),
		        'attributes' => array(
		                'required' => false,
		                'placeholder' => '375295555555',
		        )
		));		
		$this->add(array(
		        'type' => 'Zend\Form\Element\Select',
		        'name' => 'executor',
		        'options' => array(
		                'value_options' => array(
		                        '0' => 'Красовская Анна Владимировна',
		                        '1' => 'Свирченкова Юлия Вячеславовна',
		                        '2' => 'Новицкий Андрей Валерьевич',
		                ),
		                'label' => 'Исполнители',
		        ),
		        'attributes' => array(
		                'required' => true,
		                'value'    =>0
		        )
		));
		$this->add(array(
                'type' => 'Zend\Form\Element\Select',
                'name' => 'booking',
                'options' => array(
                        'value_options' => array(
                                '0' => 'Самостоятельно',
                                '1' => 'Централизовано',                                
                        ),
                        'label' => 'Бронирование гостиницы',
                ),
                'attributes' => array(
                        'required' => true,
                        'value'    =>0
                )
        ));		
		$file = new Element\File('file');
		$file
		->setLabel('File Input')
		->setName('fileupload')
		->setOptions(array('label' => 'Загрузить оформленный бланк заявки (Ms Word)'))
		->setAttributes(array(
		        'id'       => 'file',
		        'multiple' => true,
		));
		$this->add($file);
         $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Отправить'
            ),
        ));   
    }   
}
