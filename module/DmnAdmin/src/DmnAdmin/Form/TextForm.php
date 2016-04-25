<?php
namespace DmnAdmin\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;   

class TextForm extends Form
{    
    public function __construct(\DmnDatabase\Entity\CciContent $data)
    {
        parent::__construct('DmnAdmin');  
        $this->setAttribute('method', 'post'); 
        $this->setHydrator(new ClassMethods(false));
        $this->setAttribute('enctype','multipart/form-data');   
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
                'value' =>$data->getId(),
            ),
        ));        
        $this->add(array(
            'name' => 'content',
            'type'    => 'Zend\Form\Element\Textarea',
            'options' => array(
                'label' => 'Описание',
             ),            
            'attributes' => array(
                'required' => true,
                'value'=>$data->getContent(),                 
            )
        ));
        $this->add(array(
            'name' => 'title',
            'type'    => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Заголовок',
             ),            
            'attributes' => array(
                'required' => true,
                'value'=>$data->getTitle(),                 
            )
        )); 
         $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Изменить'
            ),
        ));   
    }   
}
