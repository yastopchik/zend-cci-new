<?php
namespace DmnDatabase\Data;

use DmnDatabase\Mapper\AbstractMapper;

class FormsMapper extends AbstractMapper implements FormsMapperInterface {
   
    /**
     * @dependency_table CciForms
     */
    private $entityNameForms = 'DmnDatabase\Entity\CciForms';    
    
    /**     
     *
     * @param int $id 
     * @return mixed | NULL
     */
    public function getFormsById($id){
        
        $em=$this->doctrineEntity;       
        
    }
    /**
     *
     * @return query
     */
    public function getForms() {
    
    	$em=$this->doctrineEntity;
    	$query=$em->createQueryBuilder()
    				->from($this->entityNameForms, 'f')
    				->select("f.id, f.forms")        			 
   					->orderBy('f.id', 'ASC')
        			->getQuery();
    
    	return $query;
    
    }
    
}

