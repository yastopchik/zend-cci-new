<?php

namespace DmnDatabase\Service;

use DmnDatabase\Data\UserMapperInterface;
use Zend\Cache\Storage\Adapter\Filesystem;

class UserService{   
    
    /**
     *
     * @var UserMapperInterface
     */
    private $mapperRequest;
    /**
     *
     * @var Role
     */
    private $role;
    
    /**
    
    * @param UserMapperInterface $mapperRequest, Filesystem $cache
    */
    public function __construct(UserMapperInterface $mapperRequest, Filesystem $cache) {
        
        $this->mapperRequest = $mapperRequest;
        $this->cache = $cache;
    }
    public function getUserByOrgId($orgId) {  
    	
    	return $this->mapperRequest->getUserNameByOrgId($orgId);
    } 
    public function getUserById($id) {
    	 
    	return $this->mapperRequest->getUserById($id);
    }
    public function getEntityManager() {
    
    	return $this->mapperRequest->getEntityManager();
    }
    public function getEntityUser() {
    
    	return $this->mapperRequest->getEntityUser();
    }
    public function getRole() {
    	 
    	return $this->mapperRequest->getRole();
    } 
    public function getDistributorsByUserId($userId){
    	 
    	$distributer = $this->cache->getItem('distributer_'.$userId);
    	
    	if(is_null($distributer)){
    		
    		$distributer = $this->mapperRequest->getDistributorsByUserId($userId);
    		
    		$this->cache->setItem('distributer_'.$userId, $distributer);
    	}    	
    	
    	return $distributer;
    }     
    public function editUser($data, $oper) {
    	
    	if (empty($data) || empty($oper)) {
    		throw new \InvalidArgumentException('Data or Operation  can\'t be empty');
    	}  
    	if(strcmp($oper, 'edit')==0)  	 
    		return $this->mapperRequest->editUser($data);
    	if(strcmp($oper, 'add')==0)
    		return $this->mapperRequest->addUser($data);
    }
    public function setIscci($iscci){
    	 
    	if (is_null($iscci)) {
    		throw new \InvalidArgumentException('Iscci  can\'t be empty');
    	}
    	return $this->mapperRequest->setIscci($iscci);
    }

}

?>