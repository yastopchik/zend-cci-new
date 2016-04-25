<?php
namespace DmnFea\Form;
 
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface; 
use Zend\Validator\StringLength;
 
class FeaFilter implements InputFilterAwareInterface
{  
        
    protected $inputFilter;        
    
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }
     
    public function getInputFilter()
    {  
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();         
            $inputFilter->add($factory->createInput(array(
                    'name'     => 'request',
                    'required' => true,
                    'filters'  => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                    ),
                    'validators' => array(
                            array(
                                    'name'    => 'StringLength',
                                    'options' => array(
                                            'encoding' => 'UTF-8',
                                            'min'      => 3,
                                            'max'      => 255,
                                            'messages' => array( 
                                                    \Zend\Validator\StringLength::TOO_SHORT => "Введенный текст должен быть больше чем %min% символа!",
                                                    \Zend\Validator\StringLength::TOO_LONG  => "Введенный текст должен быть меньше чем %max% символ.!"
                                            ),
                                    ),
                            ),                                                      
                    ),
            )));
         $inputFilter->add($factory->createInput(array(
            'name'     => 'dateBegin',
             'required' => true,
             'validators' => array(
                array(
                    'name'    => 'NotEmpty',
                    'options' => array(
                        'messages' => array( 
                            'isEmpty' => 'Введите дату',
                        ),
                    ),
                ),
                array( 
                    'name'=>'Date',
                    'break_chain_on_failure'=>true,
                    'options'=>array(
                        'format'=>'Y-m-d',
                        'messages'=>array(
                            'dateFalseFormat'=>'Правильный формат даты: yyyy-mm-dd',
                            'dateInvalidDate'=>'Неверная дата'
                        ),
                    ),     
                ),
                array(
                    'name'    => 'GreaterThan',
                    'options' => array(
                        'min' => date('Y-m-d'),                        
                        'messages' => array( 
                            'notGreaterThan' => 'Дата должна быть позднее:'.date('Y-m-d'),
                        ),
                    ),
                ),
            ),
         )));         
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'dateEnd',
                 'required' => true,
                 'validators' => array(
                         array(
                                 'name'    => 'NotEmpty',
                                 'options' => array(
                                         'messages' => array(
                                                 'isEmpty' => 'Введите дату',
                                         ),
                                 ),
                         ),
                         array(
                                 'name'=>'Date',
                                 'break_chain_on_failure'=>true,
                                 'options'=>array(
                                         'format'=>'Y-m-d',
                                         'messages'=>array(
                                                 'dateFalseFormat'=>'Правильный формат даты: yyyy-mm-dd',
                                                 'dateInvalidDate'=>'Неверная дата'
                                         ),
                                 ),
                         ),
                         array(
                                 'name'    => 'GreaterThan',
                                 'options' => array(
                                         'min' => date('Y-m-d'),
                                         'messages' => array(
                                                 'notGreaterThan' => 'Дата должна быть позднее:'.date('Y-m-d'),
                                         ),
                                 ),
                         ),
                 ),
         )));
         $inputFilter->add($factory->createInput(array(
                    'name'     => 'organization',
                    'required' => true,
                    'filters'  => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                    ),
                    'validators' => array(
                            array(
                                    'name'    => 'StringLength',
                                    'options' => array(
                                            'encoding' => 'UTF-8',
                                            'min'      => 3,
                                            'max'      => 255,
                                            'messages' => array(
                                                    \Zend\Validator\StringLength::TOO_SHORT => "Введенный текст должен быть больше чем %min% символа!",
                                                    \Zend\Validator\StringLength::TOO_LONG  => "Введенный текст должен быть меньше чем %max% символ.!"
                                            ),
                                    ),
                            ),                                                      
                    ),
         )));        
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'unp',
                 'required' => true,
                 'filters'  => array(
                         array('name' => 'StripTags'),
                         array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                         array(
                                 'name'    => 'Regex',
                                 'options' => array(
                                         'pattern' => '/^[0-9]+$/',
                                         'messages' => array(
                                                 'regexNotMatch'=>'Необходимо вводить только цифры'
                                         ),
                                 )),
                 ),
         )));
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'phone',
                 'required' => true,
                 'filters'  => array(
                         array('name' => 'StripTags'),
                         array('name' => 'StringTrim'),
                 ),                 
         )));
         $inputFilter->add($factory->createInput(array(
                'name'     => 'email',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'EmailAddress',
                        'options' => array(
                            'messages' => array(
                            \Zend\Validator\EmailAddress::INVALID_FORMAT => 'Неверный формат электронной почты'
                          ) 
                      ),
                    ), 
                )                    
         )));
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'fio',
                 'required' => true,
                 'filters'  => array(
                         array('name' => 'StripTags'),
                         array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                         array(
                                 'name'    => 'StringLength',
                                 'options' => array(
                                         'encoding' => 'UTF-8',
                                         'min'      => 3,
                                         'max'      => 255,
                                         'messages' => array(
                                                 \Zend\Validator\StringLength::TOO_SHORT => "Введенный текст должен быть больше чем %min% символа!",
                                                 \Zend\Validator\StringLength::TOO_LONG  => "Введенный текст должен быть меньше чем %max% символ.!"
                                         ),
                                 ),
                         ),
                 ),
         )));
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'rule',
                 'required' => false,
                 'filters'  => array(
                         array('name' => 'StripTags'),
                         array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                         array(
                                 'name'    => 'StringLength',
                                 'options' => array(
                                         'encoding' => 'UTF-8',
                                         'min'      => 3,
                                         'max'      => 255,
                                         'messages' => array(
                                                 \Zend\Validator\StringLength::TOO_SHORT => "Введенный текст должен быть больше чем %min% символа!",
                                                 \Zend\Validator\StringLength::TOO_LONG  => "Введенный текст должен быть меньше чем %max% символ.!"
                                         ),
                                 ),
                         ),
                 ),
         )));
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'bank',
                 'required' => false,
                 'filters'  => array(
                         array('name' => 'StripTags'),
                         array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                         array(
                                 'name'    => 'StringLength',
                                 'options' => array(
                                         'encoding' => 'UTF-8',
                                         'min'      => 3,
                                         'max'      => 255,
                                         'messages' => array(
                                                 \Zend\Validator\StringLength::TOO_SHORT => "Введенный текст должен быть больше чем %min% символа!",
                                                 \Zend\Validator\StringLength::TOO_LONG  => "Введенный текст должен быть меньше чем %max% символ.!"
                                         ),
                                 ),
                         ),
                 ),
         )));
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'place',
                 'required' => false,
                 'filters'  => array(
                         array('name' => 'StripTags'),
                         array('name' => 'StringTrim'),
                 ),                 
         )));
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'mphone',
                 'required' => false,
                 'filters'  => array(
                         array('name' => 'StripTags'),
                         array('name' => 'StringTrim'),
                 ),                 
         )));       
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'booking',
                 'required' => true,
         )));
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'executor',
                 'required' => true,
         )));        
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'fileupload',
                 'required' => false,
         )));
         $this->inputFilter = $inputFilter;
        }          
        return $this->inputFilter; 
        
    }
   

}
