<?php
namespace DmnAdmin\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;   

class WorkTimeForm extends Form
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
            'name' => 'title',
            'type'    => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Заголовок',
            ),
            'attributes' => array(
                'value'=>$data->getTitle(),
            )
        ));

        //Понедельник
        $this->add(array(
            'name' => 'mondey-open',
            'type'    => 'Zend\Form\Element\Time',
            'options' => array(
                'label' => 'Пн',
             ),            
            'attributes' => array(
                'value'=>'',
            )
        ));
        $this->add(array(
            'name' => 'mondey-close',
            'type'    => 'Zend\Form\Element\Time',
            'options' => array(
                'label' => 'Пн',
            ),
            'attributes' => array(
                'value'=>'',
            )
        ));
        $this->add(array(
            'name' => 'monday_weekend',
            'type'    => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'label' => 'Выходной',
            ),
        ));
        //Вторник
        $this->add(array(
            'name' => 'tuesday-open',
            'type'    => 'Zend\Form\Element\Time',
            'options' => array(
                'label' => 'Вт',
            ),
            'attributes' => array(
                'value'=>'',
            )
        ));
        $this->add(array(
            'name' => 'tuesday-close',
            'type'    => 'Zend\Form\Element\Time',
            'options' => array(
                'label' => 'Вт',
            ),
            'attributes' => array(
                'value'=>'',
            )
        ));
        $this->add(array(
            'name' => 'tuesday_weekend',
            'type'    => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'label' => 'Выходной',
            ),
        ));
        //среда
        $this->add(array(
            'name' => 'wednesday-open',
            'type'    => 'Zend\Form\Element\Time',
            'options' => array(
                'label' => 'Ср',
            ),
            'attributes' => array(
                'value'=>'',
            )
        ));
        $this->add(array(
            'name' => 'wednesday-close',
            'type'    => 'Zend\Form\Element\Time',
            'options' => array(
                'label' => 'Ср',
            ),
            'attributes' => array(
                'value'=>'',
            )
        ));
        $this->add(array(
            'name' => 'wednesday_weekend',
            'type'    => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'label' => 'Выходной',
            ),
        ));
        //четверг
        $this->add(array(
            'name' => 'thursday-open',
            'type'    => 'Zend\Form\Element\Time',
            'options' => array(
                'label' => 'Чт',
            ),
            'attributes' => array(
                'value'=>'',
            )
        ));
        $this->add(array(
            'name' => 'thursday-close',
            'type'    => 'Zend\Form\Element\Time',
            'options' => array(
                'label' => 'Чт',
            ),
            'attributes' => array(
                'value'=>'',
            )
        ));
        $this->add(array(
            'name' => 'thursday_weekend',
            'type'    => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'label' => 'Выходной',
            ),
        ));
        //пятница
        $this->add(array(
            'name' => 'friday-open',
            'type'    => 'Zend\Form\Element\Time',
            'options' => array(
                'label' => 'Пт',
            ),
            'attributes' => array(
                'value'=>'',
            )
        ));
        $this->add(array(
            'name' => 'friday-close',
            'type'    => 'Zend\Form\Element\Time',
            'options' => array(
                'label' => 'Пт',
            ),
            'attributes' => array(
                'value'=>'',
            )
        ));
        $this->add(array(
            'name' => 'friday_weekend',
            'type'    => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'label' => 'Выходной',
            ),
        ));
        //Суббота
        $this->add(array(
            'name' => 'saturday-open',
            'type'    => 'Zend\Form\Element\Time',
            'options' => array(
                'label' => 'Суб',
            ),
            'attributes' => array(
                'value'=>'',
            )
        ));
        $this->add(array(
            'name' => 'saturday-close',
            'type'    => 'Zend\Form\Element\Time',
            'options' => array(
                'label' => 'Суб',
            ),
            'attributes' => array(
                'value'=>'',
            )
        ));
        $this->add(array(
            'name' => 'saturday_weekend',
            'type'    => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'label' => 'Выходной',
            ),
        ));
        //воскрес
        $this->add(array(
            'name' => 'sunday-open',
            'type'    => 'Zend\Form\Element\Time',
            'options' => array(
                'label' => 'Вос',
            ),
            'attributes' => array(
                'value'=>'',
            )
        ));
        $this->add(array(
            'name' => 'sunday-close',
            'type'    => 'Zend\Form\Element\Time',
            'options' => array(
                'label' => 'Вос',
            ),
            'attributes' => array(
                'value'=>'',
            )
        ));
        $this->add(array(
            'name' => 'sunday_weekend',
            'type'    => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'label' => 'Выходной',
            ),
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
