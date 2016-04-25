<?php

namespace DmnDatabase\Service;

use DmnDatabase\Data\PriorityMapperInterface;

class PriorityService{   
    
    /**
     *
     * @var PriorityMapperInterface
     */
    private $mapperRequest;        
    
    public function __construct(PriorityMapperInterface $mapperRequest) {
        
        $this->mapperRequest = $mapperRequest;
    }
    public function getPriorityByPriorityId($priorityId) {
    	if (empty($priorityId)) {
    		throw new \InvalidArgumentException('Priority id can\'t be empty');
    	}
    	return $this->mapperRequest->getPriorityByPriorityId($priorityId);
    }
    public function getPriorities() {
    	 
    	return $this->mapperRequest->getPriorities();
    }

  

}

?>