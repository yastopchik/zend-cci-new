<?php

namespace DmnDatabase\Service;

use DmnDatabase\Data\CountryMapperInterface;

class CountryService{   
    
    /**
     *
     * @var CountryMapperInterface
     */
    private $mapperRequest;        
    
    public function __construct(CountryMapperInterface $mapperRequest) {
        
        $this->mapperRequest = $mapperRequest;
    }
    public function getCountryById($id) {
    	if (empty($id)) {
    		throw new \InvalidArgumentException('Priority id can\'t be empty');
    	}
    	return $this->mapperRequest->getCountryById($id);
    }
    public function getCountries() {
    	 
    	return $this->mapperRequest->getCountries();
    }
    public function getExecutorCities() {
    
    	return $this->mapperRequest->getExecutorCities();
    }

  

}

?>