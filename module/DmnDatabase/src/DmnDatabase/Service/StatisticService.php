<?php

namespace DmnDatabase\Service;

use DmnDatabase\Data\StatisticMapperInterface;

class StatisticService{   
    
    /**
     *
     * @var StatisticMapperInterface
     */
    private $mapperRequest;        
    
    public function __construct(StatisticMapperInterface $mapperRequest) {
        
        $this->mapperRequest = $mapperRequest;
    }
    public function getStatisticByStatisticId($statisticId) {
    	if (empty($statisticId)) {
    		throw new \InvalidArgumentException('Statistic id can\'t be empty');
    	}
    	return $this->mapperRequest->getStatisticByStatisticId($statisticId);
    }
    public function getCountOfRequestByForms($period){
        if (!is_array($period)) {
            throw new Exception\RuntimeException(sprintf('Failed to set varible $period. It is not an array', __CLASS__));    	}
    
            return $this->mapperRequest->getCountOfRequestByForms($period);
    }
    public function getCountOfRequestByClients($period){
        if (!is_array($period)) {
            throw new Exception\RuntimeException(sprintf('Failed to set varible $period. It is not an array', __CLASS__));    	}
    
            return $this->mapperRequest->getCountOfRequestByClients($period);
    }
    public function getCountOfRequestByExecutors($period){
        if (!is_array($period)) {
            throw new Exception\RuntimeException(sprintf('Failed to set varible $period. It is not an array', __CLASS__));    	}
    
            return $this->mapperRequest->getCountOfRequestByExecutors($period);
    }
    public function getCountOfRequestByStatus($period){
        if (!is_array($period)) {
            throw new Exception\RuntimeException(sprintf('Failed to set varible $period. It is not an array', __CLASS__));    	}
    
            return $this->mapperRequest->getCountOfRequestByStatus($period);
    }
    public function getCountOfRequestByCountry($period){
        if (!is_array($period)) {
            throw new Exception\RuntimeException(sprintf('Failed to set varible $period. It is not an array', __CLASS__));    	}
    
            return $this->mapperRequest->getCountOfRequestByCountry($period);
    }
    public function setAuth($authUserId){
    
        if (!is_int(intval($authUserId))||is_null(intval($authUserId))) {
            throw new Exception\RuntimeException(sprintf('Failed to set varible $authUserId. It is not an integer or is null', __CLASS__));    	}
    
            return $this->mapperRequest->setAuthUserId($authUserId);
    }
    public function setRole($authRoleId){
    
        if (!is_int(intval($authRoleId))||is_null(intval($authRoleId))) {
            throw new Exception\RuntimeException(sprintf('Failed to set varible $authRoleId. It is not an integer or is null', __CLASS__));    	}
    
            return $this->mapperRequest->setAuthRoleId($authRoleId);
    }
}

?>