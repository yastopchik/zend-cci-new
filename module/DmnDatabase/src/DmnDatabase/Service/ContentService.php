<?php

namespace DmnDatabase\Service;

use DmnDatabase\Data\ContentMapperInterface;

class ContentService{   
    
    /**
     *
     * @var ContentMapperInterface
     */
    private $static;        
    
    public function __construct(ContentMapperInterface $mapperRequest) {
        
        $this->mapperRequest = $mapperRequest;
    }
    public function getContentById($id) {
    	if (empty($id)) {
    		throw new \InvalidArgumentException('Content id can\'t be empty');
    	}
    	return $this->mapperRequest->getContentById($id);
    }
    public function updateById(array $data) {
    	if (!is_array($data)) {
    		throw new \InvalidArgumentException('Content data can\'t be empty');
    	}
    	return $this->mapperRequest->updateById($data);
    }
    public function getContent() {
    	 
    	return $this->mapperRequest->getContent();
    }
    public function getStatic() {
    
    	return $this->mapperRequest->getStatic();
    }
	public function getContentByStatic($static) {
    	if (empty($static)) {
    		throw new \InvalidArgumentException('Static id can\'t be empty');
    	}
    	return $this->mapperRequest->getContentByStatic($static);
    }

  

}

?>