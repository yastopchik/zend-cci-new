<?php

namespace DmnDatabase\Service;

use DmnDatabase\Data\FormsMapperInterface;

class FormsService{   
    
    /**
     *
     * @var FormsMapperInterface
     */
    private $mapperRequest;        
    
    public function __construct(FormsMapperInterface $mapperRequest) {
        
        $this->mapperRequest = $mapperRequest;
    }
    public function getFormsById($id) {
    	if (empty($id)) {
    		throw new \InvalidArgumentException('Priority id can\'t be empty');
    	}
    	return $this->mapperRequest->getFormsById($id);
    }
    public function getForms() {
    	 
    	return $this->mapperRequest->getForms();
    }

  

}

?>