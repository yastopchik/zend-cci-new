<?php
namespace DmnFea\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;   
use Zend\Form\Element;

class FeaVisitForm extends Form
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
            'name' => 'organization',
            'type'    => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Наименование*',
             ),            
            'attributes' => array(
                'required' => true,                
            )
        ));			
		$this->add(array(
            'name' => 'adress',
            'type'    => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Адрес*',
             ),            
            'attributes' => array(
                'required' => true,                
            )
        ));	
		$this->add(array(
		        'name' => 'unp',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'УНП',
		        ),
		        'attributes' => array(
		                'required' => false,
		        )
		));
		$this->add(array(
		        'name' => 'fio',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'ФИО руководителя в договор, должность',
		        ),
		        'attributes' => array(
		                'required' => false,
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
		        'name' => 'site',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'Сайт',
		        ),
		        'attributes' => array(
		                'required' => false,
		        )
		));
		$this->add(array(
		        'name' => 'activity',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'Сфера деятельности',
		        ),
		        'attributes' => array(
		                'required' => false,
		        )
		));
		$this->add(array(
		 'name' => 'members',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'ФИО участника (полностью)*',
		        ),
		        'attributes' => array(
		                'required' => true,
		        )
		));
		$this->add(array(
		        'name' => 'position',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'Должность*',
		        ),
		        'attributes' => array(
		                'required' => true,
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
		        'name' => 'wphone',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'Рабочий телефон',
		        ),
		        'attributes' => array(
		                'required' => false,
		                'placeholder' => '375222778034',
		        )
		));
		$this->add(array(
            'name' => 'email',
            'type'    => 'Zend\Form\Element\Email',
            'options' => array(
                'label' => 'Эл.почта',
             ),            
            'attributes' => array(
                'required' => false,   
                'placeholder' => 'example@gmail.com',
            )
        ));	
		//Visa
		$this->add(array(
		        'name' => 'surname',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'Фамилия при рождении/предыдущая/девичья',
		        ),
		        'attributes' => array(
		                'required' => false,
		        )
		));
		$this->add(array(
		        'name' => 'marital',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'Семейное положение',
		        ),
		        'attributes' => array(
		                'required' => false,
		        )
		));
		$this->add(array(
		        'name' => 'home',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'Домашний адрес и адрес электронной почты, номер телефона',
		        ),
		        'attributes' => array(
		                'required' => false,
		        )
		));
		$this->add(array(
		        'name' => 'proffesional',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'Профессиональная деятельность в настоящее время',
		        ),
		        'attributes' => array(
		                'required' => false,
		        )
		));
		$this->add(array(
		        'name' => 'employer',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'Работодатель; адрес и телефон работодателя',
		        ),
		        'attributes' => array(
		                'required' => false,
		        )
		));
		$this->add(array(
		        'name' => 'visa',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'Шенгенские визы, выданные за последние 3 года',
		        ),
		        'attributes' => array(
		                'required' => false,
		        )
		));
		$this->add(array(
		        'name' => 'validity',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'Срок действия с__до',
		        ),
		        'attributes' => array(
		                'required' => false,
		        )
		));
		$this->add(array(
		        'name' => 'ccontact',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'ФИО контактного лица*',
		        ),
		        'attributes' => array(
		                'required' => true,
		        )
		));
		$this->add(array(
		        'name' => 'cmphone',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'Мобильный телефон',
		        ),
		        'attributes' => array(
		                'required' => false,
		                'placeholder' => '375222778034',
		        )
		));
		$this->add(array(
		        'name' => 'cwphone',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'Рабочий телефон',
		        ),
		        'attributes' => array(
		                'required' => false,
		                'placeholder' => '375222778034',
		        )
		));
		$this->add(array(
		        'name' => 'cemail',
		        'type'    => 'Zend\Form\Element\Email',
		        'options' => array(
		                'label' => 'Эл.почта',
		        ),
		        'attributes' => array(
		                'required' => false,
		                'placeholder' => 'example@gmail.com',
		        )
		));
		$this->add(array(
		        'name' => 'cfax',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'Факс',
		        ),
		        'attributes' => array(
		                'required' => false,
		                'placeholder' => '375222778034',
		        )
		));
		$this->add(array(
		 'name' => 'intresting',
		        'type'    => 'Zend\Form\Element\Textarea',
		        'options' => array(
		                'label' => 'Сфера интересов в стране проведения мероприятия',
		        ),
		        'attributes' => array(
		                'required' => false,
		        )
		));
		$this->add(array(
		        'name' => 'company',
		        'type'    => 'Zend\Form\Element\Textarea',
		        'options' => array(
		                'label' => 'Компании в стране (регионе) проведения мероприятия, в установлении контактов с которыми заинтересовано предприятие',
		        ),
		        'attributes' => array(
		                'required' => false,
		        )
		));		
		$this->add(array(
            'name' => 'info',
            'type'    => 'Zend\Form\Element\Textarea',
            'options' => array(
                'label' => 'Дополнительная информация',
             ),            
            'attributes' => array(
                'required' => false,              
            )
        ));		
		
		$file = new Element\File('file');
		$file
		->setLabel('File Input')
		->setName('fileupload')
		->setOptions(array('label' => 'Загрузить оформленную заявку (Ms Word)'))
		->setAttributes(array(
		        'id'       => 'file',		        
		        'multiple' => true,
                        'required' => false,
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
