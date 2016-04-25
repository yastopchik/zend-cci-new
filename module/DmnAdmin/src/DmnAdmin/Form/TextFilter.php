<?php
namespace DmnAdmin\Form;
 
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface; 
 
class TextFilter implements InputFilterAwareInterface
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
            'name'     => 'content',
            'required' => true,
             'filters'  => array(                    
                    array('name' => 'StringTrim'),                   
                ),
         )));
         $inputFilter->add($factory->createInput(array(
            'name'     => 'title',
            'required' => true,
             'filters'  => array(                    
                    array('name' => 'StringTrim'),                   
                ),
         )));        
                           
         $this->inputFilter = $inputFilter;
        }          
        return $this->inputFilter; 
        
    }
   

}
