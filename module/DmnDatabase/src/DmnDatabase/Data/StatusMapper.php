<?php
namespace DmnDatabase\Data;

use DmnDatabase\Mapper\AbstractMapper;

class StatusMapper extends AbstractMapper implements StatusMapperInterface {
   
    /**
     * @dependency_table CciStatus  
     */
    private $entityNameStatus = 'DmnDatabase\Entity\CciStatus';    
    
    /**     
     *
     * @param int $statusId 
     * @return mixed | NULL
     */
    public function getStatusByStatusId($statusId){
        
        $em=$this->doctrineEntity; 
        $status = $em->find($this->entityNameStatus, 1);
        return $status;
    }
    /**
     *
     * @return query
     */
    public function getStatuses() {
    
    	$em=$this->doctrineEntity;
    	$query=$em->createQueryBuilder()
    	->from($this->entityNameStatus, 's')
    	->select("s.id, s.status")
    	->orderBy('s.id', 'ASC')
    	->getQuery();
    
    	return $query;
    
    }
    
    

}

?>