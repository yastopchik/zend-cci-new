<?php 
namespace DmnDatabase\Validator;

use DoctrineModule\Validator\ObjectExists;
use Zend\Validator\Exception;  

class NoObjectExistsNoExclude extends ObjectExists
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
       
       if (isset($options['noexclude'])) {
        $this->exclude =  $options['noexclude'];   
        }   
    } 
   
    public function isValid($value)
    {  
        $value=$this->cleanSearchValue($value); 
        $noexclude=$this->exclude; 
        $repository=$this->objectRepository;       
        $i=1;
        $qb=$repository->createQueryBuilder('i')
        ->select('COUNT(i.id) as countid');
        foreach($value as $key=>$data){
          $pos = strpos($key, '.');
        	if(!$pos){
        		$key='i.'.$key;
        	}
        	$qb->andWhere($key.' = ?'.$i)
        	->setParameter($i, $data);
        	$i++;
        }
        $i=1;
        foreach($noexclude as $key=>$data){
        	$pos = strpos($key, '.');
        	if(!$pos){
        		$key='i.'.$key;
        	}
        	$qb->andWhere($key.' != '.$data);
        	$i++;
        }        
        $match = $qb->getQuery()
        ->getSingleScalarResult();

        if ($match!=0) {
            
            $this->error(self::ERROR_OBJECT_FOUND, $value);
            return false;
            
        }        
        
        return true;
    }  
     
}
