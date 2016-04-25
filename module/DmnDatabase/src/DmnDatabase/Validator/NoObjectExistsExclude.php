<?php 
namespace DmnDatabase\Validator;

use DoctrineModule\Validator\ObjectExists;
use Zend\Validator\Exception;  

class NoObjectExistsExclude extends ObjectExists
{   
    const ERROR_OBJECT_FOUND    = 'objectFound';

    /**
     * @var array Message templates
     */
    protected $messageTemplates = array(
        self::ERROR_OBJECT_FOUND    => "An object matching '%value%' was found",
    );
    
    
    public function __construct(array $options)
    {  
       parent::__construct($options); 
       
       if (isset($options['exclude'])) {
        $this->exclude =  $options['exclude'];   
        }   
    } 
   
    public function isValid($value)
    {  
        $value =array_merge($this->cleanSearchValue($value), $this->exclude);       
        $match = $this->objectRepository->findOneBy($value);

        if (is_object($match)) {
            
            $this->error(self::ERROR_OBJECT_FOUND, $value);
            return false;
            
        }        
        
        return true;
    }  
     
}
