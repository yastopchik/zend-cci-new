<?php
namespace DmnDatabase\Data;

use DmnDatabase\Mapper\AbstractMapper;

class LifecycleMapper extends AbstractMapper implements LifecycleMapperInterface {
   
    /**
     * @dependency_table CciLifecycle  
     */
    private $entityNameLifecycle = 'DmnDatabase\Entity\CciLifecycle';    
    
    /**     
     *
     * @param int $requestId 
     * @return data | NULL
     */
    public function getLifecycleByRequestId($requestId){
    	
      $em=$this->doctrineEntity;
      
      $query=$em->createQueryBuilder()
        	->from($this->entityNameLifecycle, 'lc')
        	->select("lc.id, lc.acceped, lc.working, lc.issuance, lc.proceed, lc.duplicate, lc.exchange, lc.notindemand, lc.damaged, lc.suspended, lc.nodocuments")        	
        	->where("lc.sertificatenumid =:id")
        	->setParameter('id', $requestId)        	
        	->getQuery();
       return $query;
        
    }
    

}

?>