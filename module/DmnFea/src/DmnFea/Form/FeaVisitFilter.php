<?php
namespace DmnFea\Form;
 
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface; 
 
class FeaVisitFilter implements InputFilterAwareInterface
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
                 'name'     => 'adress',
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
                 'required' => false,
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
                 'name'     => 'fio',
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
                                         'max'      => 255,
                                         'messages' => array(                                                
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
                                         'max'      => 255,
                                         'messages' => array(                                                
                                                 \Zend\Validator\StringLength::TOO_LONG  => "Введенный текст должен быть меньше чем %max% символ.!"
                                         ),
                                 ),
                         ),
                 ),
         )));
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'site',
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
                                         'max'      => 100,
                                         'messages' => array(                                                 
                                                 \Zend\Validator\StringLength::TOO_LONG  => "Введенный текст должен быть меньше чем %max% символ.!"
                                         ),                                       
                                 ),
                         ),
                 ),
         )));
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'activity',
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
                                         'max'      => 100,
                                         'messages' => array(                                                
                                                 \Zend\Validator\StringLength::TOO_LONG  => "Введенный текст должен быть меньше чем %max% символ.!"
                                         ),
                                 ),
                         ),
                 ),
         )));
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'members',
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
                 'name'     => 'position',
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
                                         'max'      => 255,
                                         'messages' => array(                                                 
                                                 \Zend\Validator\StringLength::TOO_LONG  => "Введенный текст должен быть меньше чем %max% символ.!"
                                         ),
                                 ),
                         ),
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
                 'name'     => 'wmphone',
                 'required' => false,
                 'filters'  => array(
                         array('name' => 'StripTags'),
                         array('name' => 'StringTrim'),
                 ),                 
         )));         
         $inputFilter->add($factory->createInput(array(
                'name'     => 'email',
                'required' => false,
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
                 'name'     => 'ccontact',
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
                 'name'     => 'cmphone',
                 'required' => false,
                 'filters'  => array(
                         array('name' => 'StripTags'),
                         array('name' => 'StringTrim'),
                 ),                 
         )));
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'cwmphone',
                 'required' => false,
                 'filters'  => array(
                         array('name' => 'StripTags'),
                         array('name' => 'StringTrim'),
                 ),                 
         )));
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'cemail',
                 'required' => false,
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
                 'name'     => 'cfax',
                 'required' => false,
                 'filters'  => array(
                         array('name' => 'StripTags'),
                         array('name' => 'StringTrim'),
                 ),                 
         )));  
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'intresting',
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
                                         'max'      => 255,
                                         'messages' => array(                                                
                                                 \Zend\Validator\StringLength::TOO_LONG  => "Введенный текст должен быть меньше чем %max% символ.!"
                                         ),
                                 ),
                         ),
                 ),
         ))); 
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'company',
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
                                         'max'      => 255,
                                         'messages' => array(                                                 
                                                 \Zend\Validator\StringLength::TOO_LONG  => "Введенный текст должен быть меньше чем %max% символ.!"
                                         ),
                                 ),
                         ),
                 ),
         )));
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'info',
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
                                         'max'      => 255,
                                         'messages' => array(                                                 
                                                 \Zend\Validator\StringLength::TOO_LONG  => "Введенный текст должен быть меньше чем %max% символ.!"
                                         ),
                                 ),
                         ),
                 ),
         )));  
         
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'surname',
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
                                         'max'      => 100,
                                         'messages' => array(                                                 
                                                 \Zend\Validator\StringLength::TOO_LONG  => "Введенный текст должен быть меньше чем %max% символ.!"
                                         ),
                                 ),
                         ),
                 ),
         )));
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'marital',
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
                                         'max'      => 100,
                                         'messages' => array(                                                 
                                                 \Zend\Validator\StringLength::TOO_LONG  => "Введенный текст должен быть меньше чем %max% символ.!"
                                         ),
                                 ),
                         ),
                 ),
         )));
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'home',
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
                                         'max'      => 100,
                                         'messages' => array(                                                 
                                                 \Zend\Validator\StringLength::TOO_LONG  => "Введенный текст должен быть меньше чем %max% символ.!"
                                         ),
                                 ),
                         ),
                 ),
         )));
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'proffesional',
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
                                         'max'      => 100,
                                         'messages' => array(                                                 
                                                 \Zend\Validator\StringLength::TOO_LONG  => "Введенный текст должен быть меньше чем %max% символ.!"
                                         ),
                                 ),
                         ),
                 ),
         )));
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'employer',
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
                                         'max'      => 100,
                                         'messages' => array(                                                 
                                                 \Zend\Validator\StringLength::TOO_LONG  => "Введенный текст должен быть меньше чем %max% символ.!"
                                         ),
                                 ),
                         ),
                 ),
         )));
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'visa',
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
                                         'max'      => 100,
                                         'messages' => array(                                                
                                                 \Zend\Validator\StringLength::TOO_LONG  => "Введенный текст должен быть меньше чем %max% символ.!"
                                         ),
                                 ),
                         ),
                 ),
         )));
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'validity',
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
                                         'max'      => 100,
                                         'messages' => array(                                                
                                                 \Zend\Validator\StringLength::TOO_LONG  => "Введенный текст должен быть меньше чем %max% символ.!"
                                         ),
                                 ),
                         ),
                 ),
         )));
         $inputFilter->add($factory->createInput(array(
                 'name'     => 'fileupload',
                 'required' => false,
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
