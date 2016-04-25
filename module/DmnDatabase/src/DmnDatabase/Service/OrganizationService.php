<?php

namespace DmnDatabase\Service;

use DmnDatabase\Data\OrganizationMapperInterface;

class OrganizationService{   
    
    /**
     *
     * @var OrganizationMapperInterface
     */
    private $mapperRequest;        
    
    public function __construct(OrganizationMapperInterface $mapperRequest) {
        
        $this->mapperRequest = $mapperRequest;
    }
    public function getOrganizationByOrganizationId($organizationId) {
    	if (empty($organizationId)) {
    		throw new \InvalidArgumentException('Organization id can\'t be empty');
    	}
    	return $this->mapperRequest->getOrganizationByOrganizationId($organizationId);
    }    
    public function getOrgByUserId($authUserId){
    	if (is_null($authUserId)) {
    		throw new \InvalidArgumentException('AuthUserId id can\'t be empty');
    	}
    	return $this->mapperRequest->getOrgByUserId($authUserId);
    }
    public function getOrgUsers($search=null, $sordname='org.id', $sord='DESC'){
    	
    	return $this->mapperRequest->getOrgUsers($search, $sordname, $sord);
    }
    public function getSez(){
    	 
    	return $this->mapperRequest->getSez();
    }
    public function getEntityNameOrganization() {
    
    	return $this->mapperRequest->getEntityNameOrganization();
    }
 	public function editOrganization(array $data, $oper) {
 		
 		if (empty($data) || empty($oper)) {
 			throw new \InvalidArgumentException('Data or Operation  can\'t be empty');
 		}
 		if(strcmp($oper, 'edit')==0)
 			return $this->mapperRequest->editOrganization($data);
 		if(strcmp($oper, 'add')==0)
 			return $this->mapperRequest->addOrganization($data);    
    	
    }
    public function setIscci($iscci){
    	
    	if (is_null($iscci)) {
    		throw new \InvalidArgumentException('Iscci  can\'t be empty');
    	}  
    	return $this->mapperRequest->setIscci($iscci);
    }
    public function setParentid($parentid){
    	 
    	if (is_null($parentid)) {
    		throw new \InvalidArgumentException('Parentid  can\'t be empty');
    	}
    	return $this->mapperRequest->setParentid($parentid);
    }

  

}

?>