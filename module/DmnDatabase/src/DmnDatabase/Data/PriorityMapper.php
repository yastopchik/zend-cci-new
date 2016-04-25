<?php
namespace DmnDatabase\Data;

use DmnDatabase\Mapper\AbstractMapper;

class PriorityMapper extends AbstractMapper implements PriorityMapperInterface {
   
    /**
     * @dependency_table CciPriority  
     */
    private $entityNamePriority = 'DmnDatabase\Entity\CciPriority';    
    
    /**     
     *
     * @param int $priorityId 
     * @return mixed | NULL
     */
    public function getPriorityByPriorityId($priorityId){
        
        $em=$this->doctrineEntity;       
        
    }
    /**
     *
     * @return query
     */
    public function getPriorities() {
    
    	$em=$this->doctrineEntity;
    	$query=$em->createQueryBuilder()
    				->from($this->entityNamePriority, 'p')
    				->select("p.id, p.priority")        			 
   					->orderBy('p.id', 'ASC')
        			->getQuery();
    
    	return $query;
    
    }
    
}

