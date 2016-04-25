<?php
namespace DmnFea\Form;
 
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface; 
 
class FeaTranslateFilter implements InputFilterAwareInterface
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
                    'name'     => 'contact',
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
                 'name'     => 'fileupload',
                 'required' => false,
            )));
         $this->inputFilter = $inputFilter;
        }          
        return $this->inputFilter; 
        
    }
   

}
