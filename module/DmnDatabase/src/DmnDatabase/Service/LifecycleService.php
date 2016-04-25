<?php

namespace DmnDatabase\Service;

use DmnDatabase\Data\LifecycleMapperInterface;

class LifecycleService{   
    
    /**
     *
     * @var LifecycleMapperInterface
     */
    private $mapperRequest;        
    
    public function __construct(LifecycleMapperInterface $mapperRequest) {
        
        $this->mapperRequest = $mapperRequest;
    }
    public function getLifecycleByLifecycleId($requestId) {
    	
    	if (!is_int(intval($requestId))||is_null(intval($requestId))) {
    		throw new Exception\RuntimeException(sprintf('Failed to set varible. It is not an integer or is null requestId', __CLASS__));    	}
    	
    	return $this->mapperRequest->getLifecycleByRequestId($requestId);
    }

}

?>