<?php
namespace DmnFea\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;   
use Zend\Form\Element;

class FeaTranslateForm extends Form
{    
    public function __construct()
    {
        parent::__construct('fea');  
        $this->setAttribute('method', 'post'); 
        $this->setHydrator(new ClassMethods(false));
        $this->setAttribute('enctype','multipart/form-data'); 
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
		        'name' => 'contact',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'Контактное лицо*',
		        ),
		        'attributes' => array(
		                'required' => true,
		        )
		));
		$this->add(array(
		        'name' => 'phone',
		        'type'    => 'Zend\Form\Element\Text',
		        'options' => array(
		                'label' => 'Телефон*',
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
		->setOptions(array('label' => 'Загрузить файл для перевода (формат jpg, jpeg, gif, pdf, doc, docx, bmp)'))
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
