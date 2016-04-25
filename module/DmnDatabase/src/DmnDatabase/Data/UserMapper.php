<?php
namespace DmnDatabase\Data;

use DmnDatabase\Mapper\AbstractMapper;
use Exception;

class UserMapper extends AbstractMapper implements UserMapperInterface {
   
	
	//id роль распределителя
    private $distributerId = 4;
	
	private $parentId = 0;    
    /**
     * @dependency_table CciUserrole
     */    
    private $entityUserRole = 'DmnDatabase\Entity\CciUserrole';  
    /**
     * @dependency_table CciOrganization
     */
    private $entityNameOrganization = 'DmnDatabase\Entity\CciOrganization';
    /**
     * @dependency_table CciCity
     */
    private $entityCity = 'DmnDatabase\Entity\CciCity';
    
    /**
     * @param $orgId default=null    
     * @return query
     */
    public function getUserNameByOrgId($orgId=null) {
    
    	$em=$this->doctrineEntity;
    	$iscci=$this->getIscci();
    	if ($iscci===null) {
    		throw new \InvalidArgumentException('Iscci  can\'t be empty in OrganizationMapper');
    	}  
    	$query=$em->createQueryBuilder()
    	->from($this->entityUser, 'u')
    	->select("u, u.id,  u.login, u.password, u.email, u.name as executor,  u.nameshort, u.nameshorten, u.position, u.phone, u.activate, r.roleId, r.roleRus, u.datelastvisit, r.id as idrole")
    	->join('u.organizationid', 'o')
    	->join('u.role', 'r')
    	->where("o.iscci =:iscci")
    	->setParameter('iscci', $iscci);
    	if(!is_null($orgId)){
    	$query->andWhere("u.organizationid =:orgId")
    		  ->setParameter('orgId', $orgId);	
    	}
    	$result=$query->orderBy('u.name', 'ASC')
    		  ->getQuery();
    	 
    	return $result;
    
    }
    /**
     * @param $id  
     * @return query
     */
    public function getUserById($id) {
    
    	$em=$this->doctrineEntity;
    	$iscci=$this->getIscci();
    	if ($id===null) {
    		throw new \InvalidArgumentException('Id  can\'t be empty in getUserById');
    	}  
    	$query=$em->createQueryBuilder()
    	->from($this->entityUser, 'u')
    	->select("u, u.id,  u.login, u.password, u.email, u.name as executor, u.nameshort, u.position, u.phone, u.activate, r.roleId,  r.roleRus, u.datelastvisit, r.id as idrole, u.nameshorten,")
    	->join('u.organizationid', 'o')
    	->join('u.role', 'r')
    	->where("u.id =:id")
    	->setParameter('id', $id)
    	->orderBy('u.name', 'ASC')
    	->getQuery();
    	 
    	return $query;
    
    }
    /**
     * Get Role
     * @return query
     */
    public function getRole() {
    
    	$em=$this->doctrineEntity;
    	$query=$em->createQueryBuilder()
    	->from($this->entityUserRole, 'r')
    	->select("r.id, r.roleRus")
    	->orderBy('r.id', 'ASC')
    	->getQuery();
    
    	return $query;
    
    }
    /**
     * @param userId
     * @return DistributorId
     */
    public function getDistributorsByUserId($userId){
    
    	$em=$this->doctrineEntity;
    	$query = $em->createQuery('SELECT cu.id FROM '.$this->entityUser.' cu 
    							   JOIN cu.role cr JOIN cu.organizationid co 
    							   WHERE cr.id='.$this->distributerId.' 
    							   AND co.cityid IN (
    									SELECT IDENTITY(coo.cityid) 
    									FROM '.$this->entityUser.' cuu
    									JOIN cuu.organizationid coo Where cuu.id='.$userId.')');
    	$distributorsId = $query->getResult();    	
    	if(empty($distributorsId)){
    		$query = $em->createQuery('SELECT cu.id FROM '.$this->entityUser.' cu
    							   JOIN cu.role cr 
    							   JOIN cu.organizationid co
    							   JOIN co.cityid cc    							   
    							   WHERE cr.id='.$this->distributerId.' AND co.parentid='.$this->parentId.'
    							   AND cc.idregion IN (
    									SELECT IDENTITY(ccc.idregion)
    									FROM '.$this->entityUser.' cuu
    									JOIN cuu.organizationid coo 
    									JOIN coo.cityid ccc	    								    
    									WHERE cuu.id='.$userId.')');
    		$distributorsId = $query->getResult(); 
    	}
    	if(empty($distributorsId)){
    		return 2;
    	}else{
    		foreach ($distributorsId as $distributorId){
    			return $distributorId['id'];
    		}
    	}    	
    }
    /**
     * @return true | false
     */
    public function editUser(array $data){
    	$em=$this->doctrineEntity; 
    	if(!is_null($data['id'])){
    	$em->getConnection()->beginTransaction();
    	  try { 
    			$user=$em->find($this->entityUser, $data['id']);    		
    			if(!is_null($data['login'])&&!empty($data['login']))
    				$user->setLogin(addslashes($data['login'])); 
    			if(!is_null($data['email'])&&!empty($data['email']))
    				$user->setEmail(addslashes($data['email']));   
    			if(!is_null($data['name'])&&!empty($data['name']))
    				$user->setName(addslashes($data['name']));   
    			if(!is_null($data['nameshort'])&&!empty($data['nameshort']))
    				$user->setNameShort(addslashes($data['nameshort']));
    			if(!is_null($data['nameshorten'])&&!empty($data['nameshorten']))
    			    $user->setNameShorten(addslashes($data['nameshorten']));
    			if(!is_null($data['position'])&&!empty($data['position']))
    				$user->setPosition(addslashes($data['position']));    	
    			if(!is_null($data['phone']))
    				$user->setPhone(addslashes($data['phone']));
    			if($data['activate']==0 || $data['activate']==1)
    				$user->setActivate($data['activate']);    		
    			if(!is_null($data['roleRus'])&&!empty($data['roleRus'])){
       	    		foreach ($user->getRole() AS $roleold) {    					
    					$user->removeRole($roleold);
					}    		   		
    			}
    		    $user->getRole()->add($em->find($this->entityUserRole, $data['roleRus']));    		    		
    			$em->persist($user);    		
    			$em->flush();    		
    			$em->getConnection()->commit(); 
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
    /**
     * @var $data
     * @return true|false
     */
    public function addUser(array $data) {
    
    	$add=false;
    	$em=$this->doctrineEntity;
    	if(!empty($data)){
    	 $em->getConnection()->beginTransaction();
    	 try {	
    			$insertuser = new $this->entityUser;
    			$insertuser->setLogin(addslashes($data['login']));    			
    			$insertuser->setPassword($data['password']);
    			$insertuser->setEmail(addslashes($data['email']));
    			$insertuser->setName(addslashes($data['name']));
    			$insertuser->setNameShort(addslashes($data['nameshort']));
    			$insertuser->setNameshorten(addslashes($data['nameshorten']));
    			$insertuser->setPosition(addslashes($data['position']));
    			$insertuser->setPhone(addslashes($data['phone']));
    			$insertuser->setActivate(intval($data['activate']));
    			$insertuser->setOrganizationid($em->find($this->entityNameOrganization, $data['organizationid']));    			
    			$insertuser->setDatelastvisit(new \DateTime("now"));
    			$insertuser->getRole()->add($em->find($this->entityUserRole, $data['roleRus']));
    			$em->persist($insertuser);
    			$em->flush();    					
    			$em->getConnection()->commit();
    			$add=true;
    	 }catch (Exception $e) {
    			$em->getConnection()->rollback();
    			$em->close();
    			throw $e;
    	}    	
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
    
}

?>