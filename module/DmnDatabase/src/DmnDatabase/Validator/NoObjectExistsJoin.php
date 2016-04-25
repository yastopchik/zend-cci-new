<?php 
namespace DmnDatabase\Validator;

use DoctrineModule\Validator\ObjectExists;
use Zend\Validator\Exception;  

class NoObjectExistsJoin extends ObjectExists
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
       if (isset($options['on'])) {
        $this->on =  $options['on'];   
        }      
    } 
   
    public function isValid($value, $file=null)
    {  
        if(!is_null($file))
        	$value=$file['name'];
    	
    	$value =array_merge($this->cleanSearchValue($value), $this->exclude);
        $repository=$this->objectRepository;  
        $on=$this->on;
        $i=1;
        $qb=$repository->createQueryBuilder('i')
                       ->select('COUNT(i.id) as countid')
                       ->join(''.$on.'', 'j');
        foreach($value as $key=>$data){
           $pos = strpos($key, '.'); 
           if(!$pos){
            $key='i.'.$key;   
           }
             $qb->andWhere($key.' = ?'.$i)
                ->setParameter($i, $data);
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
