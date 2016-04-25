<?php
namespace DmnDatabase\Data;

use DmnDatabase\Mapper\AbstractMapper;
use Exception;
use Doctrine\ORM\QueryBuilder;

class OrganizationMapper extends AbstractMapper implements OrganizationMapperInterface {
   
    /**
     * @dependency_table CciOrganization
     */
    private $entityNameOrganization = 'DmnDatabase\Entity\CciOrganization'; 
    /**
     * @dependency_table CciSez
     */
    private $entityNameSez= 'DmnDatabase\Entity\CciSez';
    /**
     * @dependency_table CciCity
     */
    private $entityCity = 'DmnDatabase\Entity\CciCity';    
    /**
     *
     * @var $iscci
     */
    private $iscci;
    /**
     *
     * @var $parentid
     */
    private $parentid;
    
    /**     
     *
     * @param int $organizationId 
     * @return mixed | NULL
     */
    public function getOrganizationByOrganizationId($organizationId){
        
        $em=$this->doctrineEntity;       
        
    }
    /**
     *     
     * @return data | NULL
     */
    public function getOrgUsers($search, $sordname, $sord){
    
    	$em=$this->doctrineEntity;
    	$iscci=$this->getIscci();
    	if ($iscci===null) {
 			throw new \InvalidArgumentException('Iscci  can\'t be empty in OrganizationMapper');
 		}
    	$query=$em->createQueryBuilder()
    	->from($this->entityNameOrganization, 'org')
    	->select("org, org.id, org.name, org.fullname, org.fullnameen, c.nameru as city, org.address, org.addressen, org.phone, 
    				org.unp, c.id as cityid, org.contract, org.datecontract, r.sezname")
    	->join('org.cityid', 'c')
    	->join('org.isresident', 'r')
    	->where("org.iscci =:iscci")
    	->setParameter('iscci', $iscci);
    	if(!empty($search))
    		$query=$this->convertSearchToWhere($query, $search);
    	$result=$query->orderBy($sordname, $sord)
    	->getQuery();
    	 
    	return $result;
    
    }
    /**
     *Add search params in main query
     *@params QueryBuilder $query, json string
     * @return query
     */
    public function convertSearchToWhere(QueryBuilder $query, $search){
    	$allowedOperations = array('AND', 'OR');
    	$allowedFields	   = array('name', 'unp', 'contract', 'datecontract');
    	$search=json_decode($search);
    	if(is_object($search) && (count($search->rules)<10)){
    		foreach ($search->rules as $rule) {
    			if (in_array($rule->field, $allowedFields)) {
    				switch ($rule->field) {
    					case 'name': $qWhere = 'org.'.$rule->field.' = :name';
    					$qParametrs='name';
    					break;
    					case 'unp': $qWhere = 'org.'.$rule->field.' = :unp';
    					$qParametrs='unp';
    					break;
    					case 'datecontract': $qWhere = 'org.'.$rule->field.' = :datecontract';
    					$qParametrs='datecontract';
    					break;    					
    					case 'contract': $qWhere = 'org.'.$rule->field.' = :contract';
    					$qParametrs='contract';
    					break;
    				}
    				if(strcmp($search->groupOp, 'AND')==0)
    					$query->andWhere($qWhere);
    				elseif(strcmp($search->groupOp, 'OR')==0)
    				$query->orWhere($qWhere);
    				$value=$rule->data;
    				if(strcmp('datecontract', $rule->field)==0)
    					$value=$this->convertDataToMysqlFormat($value);
    				$query->setParameter($qParametrs, $value);
    			}
    		}
    	}
    	return $query;
    }
    /**
     *
     * @return data | NULL
     */
    public function getOrgByUserId($authUserId){
    
    	$em=$this->doctrineEntity;
    	$query=$em->createQueryBuilder()
    	->from($this->entityUser, 'u')
    	->select("org.id, org.fullname, org.address, org.fullnameen, org.addressen")
        ->join('u.organizationid', 'org')
        ->where("u.id =:authUserId")
        ->setParameter('authUserId', $authUserId)
    	->getQuery();
    
    	return $query;
    
    }
    /**
     *
     * @return data | NULL
     */
    public function getSez(){
    
    	$em=$this->doctrineEntity;    	
    	$query=$em->createQueryBuilder()
    	->from($this->entityNameSez, 'sez')
    	->select("sez, sez.id, sez.sezname, sez.seznameen") 
        ->orderBy('sez.sezname', 'ASC')
        ->getQuery();
    
    	return $query;
    
    }
    /**
     * @return true | false
     */
    public function editOrganization($data){
    	$em=$this->doctrineEntity;
    	if(!is_null($data['id'])){
    		$em->getConnection()->beginTransaction();
    		try {
    		 $org=$em->find($this->entityNameOrganization, $data['id']);    			
 			 if($org instanceof \DmnDatabase\Entity\CciOrganization){
    			if(!is_null($data['name']))
    				$org->setName($data['name']);    				
    			if(!is_null($data['fullname']) && !empty($data['fullname']))
    				$org->setFullname($data['fullname']);    			
    			if(!is_null($data['city']) && is_int(intval($data['city'])))
    				$org->setCityid($em->find($this->entityCity, $data['city']));    			   			
    			if(!is_null($data['address']) && !empty($data['address']))
    				$org->setAddress($data['address']);
    			if(!is_null($data['addressen']) && !empty($data['addressen']))
    				$org->setAddressen($data['addressen']);    			
    			if(!is_null($data['phone']))
    				$org->setPhone($data['phone']);    			
    			if(!is_null($data['unp']))
    				$org->setUnp($data['unp']);    			
    			if(!is_null($data['isresident']))
    				$org->setIsresident($em->find($this->entityNameSez, $data['isresident']));  
    			if(!is_null($data['fullnameen']) && !empty($data['fullnameen']))
    				$org->setFullnameen($data['fullnameen']);
    			$em->persist($org);
    			$em->flush();
    			$em->getConnection()->commit();
 			 }
    		}
    		catch (Exception $e) {
    			$em->getConnection()->rollback();
    			$em->close();
    			throw $e;
    		}
    		return true;
    	}
    	return false;
    }
    public function addOrganization($data){
    	$em=$this->doctrineEntity;    	    	
    	if (($this->getIscci()===null)&&($this->getParentid()===null)) {
    			throw new \InvalidArgumentException('Iscci  OR Parentid can\'t be empty in OrganizationMapper');
    	 }	
    	  $em->getConnection()->beginTransaction();
    	  try {
    			$insertuser = new $this->entityNameOrganization;
    			$insertuser->setName($data['name']);    			
    			$insertuser->setFullname($data['fullname']);
    			$insertuser->setCityid($em->find($this->entityCity, intval($data['city'])));
    			$insertuser->setAddress($data['address']);    			
    			$insertuser->setPhone($data['phone']);    			
    			$insertuser->setUnp(intval($data['unp']));
    			$insertuser->setContract($data['contract']);
    	  		if($data['datecontract'] instanceof \DateTime){
    	 			$data['datecontract']=$data['datecontract']->format('Y-m-d');
    	 		}else{
    	 			$data['datecontract']=new \DateTime("now");
    	 		}    			  			
    			$insertuser->setDatecontract($data['datecontract']);
    			$insertuser->setIscci($this->getIscci());
    			$insertuser->setParentid($this->getParentid());
    			$insertuser->setIsresident($em->find($this->entityNameSez, $data['isresident']));    			
    			$em->persist($insertuser);
    			$em->flush();    					
    			$em->getConnection()->commit();
    			$add=true;
    	     }catch (Exception $e) {
    			$em->getConnection()->rollback();
    			$em->close();
    			throw $e;
    	} 
     return $add;
    }
    /**
     *
     * @return $iscci
     */
    public function getIscci(){
    
    	return $this->iscci;
    }
    /**
     *
     * @param integer $iscci
     */
    public function setIscci($iscci){    
    	
    	$this->iscci = $iscci;
    }
    /**
     * Set parentid     
     */
    public function setParentid($parentid)
    {
    	$this->parentid = $parentid;
    
    	return $this;
    }
    
    /**
     * Get parentid
     *
     * @return integer
     */
    public function getParentid()
    {
    	return $this->parentid;
    }
    /**
     * @return this entityNameOrganization
     */
    public function getEntityNameOrganization() {
    
    	return $this->entityNameOrganization;
    }

}

?>