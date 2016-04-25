<?php

namespace DmnDatabase\Service;

use DmnDatabase\Data\StatusMapperInterface;

class StatusService{   
    
    /**
     *
     * @var RequestMapperInterface
     */
    private $mapperRequest;        
    
    public function __construct(StatusMapperInterface $mapperRequest) {
        
        $this->mapperRequest = $mapperRequest;
    }
    public function getStatusByStatusId($statusId) {
    	if (empty($statusId)) {
    		throw new \InvalidArgumentException('Status id can\'t be empty');
    	}
    	$status=$this->mapperRequest->getStatusByStatusId($statusId);
    	return $status;
    }
    public function getStatuses() {
    
    	return $this->mapperRequest->getStatuses();
    }

  

}

?>