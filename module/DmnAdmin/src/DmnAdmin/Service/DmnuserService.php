<?php
namespace DmnAdmin\Service;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;;
use Zend\Cache\Storage\Adapter\Filesystem;
use Zend\Paginator\Paginator;

class DmnuserService extends DmnexecutorService{  
	
	/**
	 * Call parent construct 
	 * @param Zend\Cache\Storage\Adapter\Filesystem $cache
	 * @return __construct
	 */
	public function __construct(Filesystem $cache){
      
       parent::__construct($cache); 
       
    }   
    /**
     *Get List of User Organizations
     *@return  data
     */
    public function getOrgUsers(){
    	
    	if(isset($this->data['_search']) && ($this->data['_search'])   && !empty($this->data['filters']))
    		$search=$this->data['filters'];
    	else
    		$search=null;
    
    	$data=$this->dbOrganization->setIscci(0);
    	 
    	$data=$this->dbOrganization->getOrgUsers($search);
    
    	$adapter = new DoctrineAdapter(new ORMPaginator($data));
    
    	$paginator = new Paginator($adapter);
    
    	$paginator->setCurrentPageNumber((int)$this->page)
    	->setItemCountPerPage((int)$this->rows)
    	->setPageRange(5);
    
    	$response=$this->convertPanginationToResponce($paginator, $this->options->getOrgUserOptions());
    
    	return $response;
    
    }
    /**
     *Get List of Userss
     *@return  paginator
     */
    public function getUsers(){
    
    	if($this->id!=0){
    
    		$data=$this->dbUser->setIscci(0);
    		
    		$data=$this->dbUser->getUserByOrgId($this->id);
    
    		$adapter = new DoctrineAdapter(new ORMPaginator($data));
    		 
    		$paginator = new Paginator($adapter);
    		 
    		$paginator->setCurrentPageNumber((int)$this->page)
    		->setItemCountPerPage((int)$this->rows)
    		->setPageRange(5);
    		$response=$this->convertPanginationToResponce($paginator, $this->options->getUserOptions());
    
    
    	}else{
    		$response=array();
    	}
    	return $response;
    }
    /**
     *Get List of Sez
     *@return  data
     */
    public function getSez(){
    
    	$response = $this->cache->getItem('get_sez');
    
    	if(is_null($response)){
    
    		$data=$this->dbOrganization->getSez()->getArrayResult();
    		 
    		$response=array();
    		foreach($data as $key=>$row) {
    			$response[$key]['id']=$row['id'];
    			$response[$key]['sezname']=$row['sezname'];
    		}
    		$this->cache->setItem('get_sez', $response);
    	}
    
    	return $response;
    }
    /**
     *Edit Organization
     *@return true|false
     */
    public function editOrgUser(){ 
         
        if($this->cache->hasItem('get_execorganization')){
            $this->cache->removeItem('get_execorganization');
        }
        $this->logger->info('Редактирование/Добавление Организации -, пользователь -'.$this->authUserId);
    	
    	$this->dbOrganization->setIscci(0);
    	 
    	$this->dbOrganization->setParentid(0);
    	 
    	return $this->dbOrganization->editOrganization($this->data, $this->data['oper']);
    
    }
    /**
     *Edit User
     *@return true|false
     */
    public function editUser($orgid){
    	
    	$this->logger->info('Редактирование/Добавление Клиента -, пользователь -'.$this->authUserId);
    	 
    	$this->data['organizationid']=$orgid;
    	 
    	$this->data['name']=$this->data['executor'];
    	
    	$this->data['roleRus']=2;
    	 
    	$this->data['password']=$this->getPassword($this->data['login']);
    	 
    	return $this->dbUser->editUser($this->data, $this->data['oper']);
    
    }    

}
