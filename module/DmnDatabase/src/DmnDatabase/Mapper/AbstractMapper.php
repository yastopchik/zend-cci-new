<?php

namespace DmnDatabase\Mapper;

use Doctrine\ORM\EntityManager;
use Exception;
use Doctrine\ORM\QueryBuilder;
use Zend\ServiceManager\ServiceLocatorInterface;

class AbstractMapper {

    
    protected $authUserId;
    
    protected $authRoleId;
	
    protected $identitity;
    
    /**
     * @dependency_table CciUser
     */
    protected $entityUser = 'DmnDatabase\Entity\CciUser';
    /**
     * @dependency_table CciRequestNumber
     */
    protected $entityNameRequestNumber = 'DmnDatabase\Entity\CciRequestNumber';
	/**
	 *
	 * @var EntityManager
	 */
	protected $doctrineEntity = null;
	/**
	 *
	 * @var ServiceLocatorInterface
	 */
	protected $sm = null;
	/**
	 *
	 * @param EntityManager      	
	 */
	public function __construct(EntityManager $doctrineEntity, ServiceLocatorInterface $sm) {
		$this->doctrineEntity = $doctrineEntity;
		$this->sm = $sm;
	}
	/**
	 *
	 * @var data format 'dd/mm/yyyy'
	 */
	public function convertDataToMysqlFormat($date){		
	
    	if(preg_match("|([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})|i",$date,$regs)){
    		
    		return $regs[3].'-'.$regs[2].'-'.$regs[1];
    	}
		return date;
	}
	public function getEntityManager(){	
		
		return $this->doctrineEntity;
		
	}
	/**
	 *Addition authentication parameters in the query
	 *@params QueryBuilder $query
	 * @return query
	 */
	public function convertAuthToWhere(QueryBuilder $query) {	     
	     
	    if (($this->authUserId===null) &&($this->authRoleId===null)){
	        throw new \InvalidArgumentException('authUserId  And authRoleId can\'t be empty in convertAuthToWhere');
	    }
	    switch ($this->authRoleId) {
	        case '2': $query->andWhere('u.id =:authUserId')
	        ->setParameter('authUserId', $this->authUserId) ;
	        break;
	        case '5': $query->andWhere('e.id =:authUserId')
	        ->setParameter('authUserId', $this->authUserId) ;
	        break;
	        case '3': $query->andWhere('c.idcountry =:country')
	        ->setParameter('country', '21') ;
	        break;
	        case '4': $carray=$this->getDistributerCityByUserId()->getScalarResult();
	        if(is_array($carray)){
	            foreach ($carray as $key=>$value){
	                if($value['parentid']==0){
	                    $query->andWhere('c.idregion =:region')
	                    ->setParameter('region', $value['regionid']) ;
	                }else{
	                    $query->andWhere('c.id =:cityid')
	                    ->setParameter('cityid', $value['cityid']) ;
	                }
	            }
	        }
	        break;
	    }
	    return $query;
	}
	/**
	 * @return UserId
	 */
	public function getDistributerCityByUserId() {
	
	    $em=$this->doctrineEntity;
	    $query=$em->createQueryBuilder()
	    ->from($this->entityUser, 'u')
	    ->select("ci.id as cityid, re.id as regionid, org.parentid")
	    ->join("u.organizationid", "org")
	    ->join("org.cityid", "ci")
	    ->join("ci.idregion", "re")
	    ->where("u.id =:id")
	    ->setParameter('id', $this->authUserId)
	    ->getQuery();
	
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

	public function setAuthUserId($authUserId) {
	    	
	    $this->authUserId=$authUserId;
	}
	public function setAuthRoleId($authRoleId) {
	
	    $this->authRoleId=$authRoleId;
	}
	/**
	 * @return this entityNameRequestNumber
	 */
	public function getEntityNameRequestNumber() {
	
	    return $this->entityNameRequestNumber;
	}
	/**
	 * @return this entityUser
	 */
	public function getEntityUser() {
	
	    return $this->entityUser;
	}
	public function getUserIdentitity()
	{		
		if($this->identitity === null)
		    $this->identitity = $this->sm->get('zfcuser_auth_service')->getIdentity();
		
		return $this->identitity;
	}

}