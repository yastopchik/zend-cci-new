<?php

namespace DmnAdmin\Service;

use Zend\Cache\Storage\Adapter\Filesystem;
use DmnDatabase\Service\Exception\RuntimeException;
use Zend\Stdlib\Parameters;
use DmnDatabase\Service\UserService;
use DmnDatabase\Service\CountryService;
use DmnDatabase\Service\OrganizationService;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
use DmnAdmin\Options\GridOptionsInterface;
use DoctrineModule\Validator\NoObjectExists;
use DmnDatabase\Validator\NoObjectExistsNoExclude;
use Zend\Crypt\Password\Bcrypt;
use ZfcUser\Options\ModuleOptions as ZfcOptions;
use DmnLog\Service\LogService;

class DmnexecutorService{      
	/**
	 *
	 * @var $id
	 */	
	protected $id;
	/**
	 *
	 * @var $rows
	 */
	// get index row - i.e. user click to sort
	protected $rows;		
	/**
	 *
	 * @var $page
	 */
	// get the requested page
	protected $page;
	/**
	 *
	 * @var $data
	 */	
	protected $data=array();	
	/**
	 *
	 * @var $cache
	 */
	protected $cache;
	/**
	 *
	 * @var $options
	 */
	protected $options;
	/**
	 *
	 * @var $dbCountry
	 */
	protected $dbCountry;
	/**
	 *
	 * @var $dbOrganization
	 */
	protected $dbOrganization;
	/**
	 *
	 * @var $dbUser
	 */
	protected $dbUser;	
	/**
	 *
	 * @var $zfcUserOptions
	 */
	protected $zfcUserOptions;
	/**
	 *
	 * @var $logger
	 */
	protected $logger;
	/**
	 *
	 * @var $authUserId
	 */
	protected $authUserId;
	
	/**
	
	 * @param Zend\Cache\Storage\Adapter\Filesystem $cache
	 */
	public function __construct(Filesystem $cache)
	{		
		$this->cache = $cache;
	}	
    /**     
     *@return cache
     */
    public function getCache()
    {
    	
    	return $this->cache;
    }    
    /**
     *
     * @return $id
     */
    public function getId(){
    
    	return $this->id;
    }
    /**
     *
     * @param integer $id
     */
    public function setId($id){
    
    	if (!is_int(intval($id))||is_null(intval($id))) {
    		throw new RuntimeException(sprintf('Failed to set varible. It is not an integer or is null', __CLASS__));
    	}
    	$this->id = $id;
    }     
    /**
     *Get List of Executer Organizations
     *@return  data
     */
    public function getOrgExecutors(){
    	
    	if(isset($this->data['_search']) && ($this->data['_search'])  && !empty($this->data['filters']))
    		$search=$this->data['filters'];
    	else
    		$search=null;
    	
    	$data=$this->dbOrganization->setIscci(1);  	
    	
    	$data=$this->dbOrganization->getOrgUsers($search); 
    	 
    	$adapter = new DoctrineAdapter(new ORMPaginator($data));
    	 
    	$paginator = new Paginator($adapter);
    	 
    	$paginator->setCurrentPageNumber((int)$this->page)
    	->setItemCountPerPage((int)$this->rows)
    	->setPageRange(5);
    
    	$response=$this->convertPanginationToResponce($paginator, $this->options->getOrgExecutorOptions());
    
    	return $response;
    	 
    }
    /**
     *Get List of Executors
     *@return  paginator
     */
    public function getExecutors(){
        
    	if($this->id!=0){    		 
    		
    		$data=$this->dbUser->setIscci(1);
    		
    		$data=$this->dbUser->getUserByOrgId($this->id);
    
    		$adapter = new DoctrineAdapter(new ORMPaginator($data));
    		 
    		$paginator = new Paginator($adapter);
    		 
    		$paginator->setCurrentPageNumber((int)$this->page)
    		->setItemCountPerPage((int)$this->rows)
    		->setPageRange(5);
    		$response=$this->convertPanginationToResponce($paginator, $this->options->getExecutorOptions());
    
    
    	}else{
    		$response=array();
    	}
    	return $response;
    }
    /**
     *Edit Organization
     *@return true|false
     */
    public function editOrgExecutor(){   
    	
        if($this->cache->hasItem('get_organization')){
            $this->cache->removeItem('get_organization');
        }  
        $this->logger->info('Редактирование/Добавление Организации Исполнителя -, пользователь -'.$this->authUserId);
    	
    	//Добавить в случае необходимости добавления новых организаций для исполнителей
    	$this->dbOrganization->setIscci(1);
    	
    	$this->dbOrganization->setParentid(0);  
    	
    	return $this->dbOrganization->editOrganization($this->data, $this->data['oper']);
    
    }
    /**
     *Edit Executor
     *@return true|false
     */
    public function editExecutor($orgid=1){ 

    	$this->logger->info('Редактирование/Добавление Исполнителя -, пользователь -'.$this->authUserId);
    	
    	$this->data['organizationid']=$orgid;
    	
    	$this->data['name']=$this->data['executor'];
    	
    	$this->data['password']=$this->getPassword($this->data['login']);
    	
    	return $this->dbUser->editUser($this->data, $this->data['oper']);
    
    }
    /**
     * get Bcrypt password
     * @var $password
     * @return password
     */
    public function getPassword($password)
    {
    	if(!empty($password)){    		
    		$bcrypt = new Bcrypt;
    		$bcrypt->setCost($this->zfcUserOptions->getPasswordCost());
    		$password = $bcrypt->create($password);
    	}
    	return $password;
    }
    /**
     *convertPanginationToResponde
     *@param Paginator paginator,  options, rotate=false
     *@return data
     */
    public function convertPanginationToResponce(Paginator $paginator, array $options, $rotate=false, $response=array()){
    	 
    	$response['records']=$paginator->count();
    	$response['page'] = $this->page;
    	$response['total']= ceil($paginator->getTotalItemCount()/$this->rows);
    	$i=0;
    	foreach($paginator as $key=>$row){
    		if(!$rotate){
    			$response['rows'][$key]['id']=$row['id'];
    			$response['rows'][$key]['cell']=array();
    			foreach($row as $keys=>$value){
    				if(array_key_exists($keys, $options['options'])){
    					if($value instanceof \DateTime){
    						$value=$value->format('d/m/Y');
    					}
    					array_push($response['rows'][$key]['cell'], stripslashes($value));
    				}
    			}
    		}else{
    			foreach($row as $keys=>$value){
    				if(array_key_exists($keys, $options['options'])){
    					$response['rows'][$i]['id']=$i;
    					$response['rows'][$i]['cell']=array();
    					if($value instanceof \DateTime){
    						$value=$value->format('d.m.Y');
    					}
    					array_push($response['rows'][$i]['cell'], $options['options'][$keys]);
    					array_push($response['rows'][$i]['cell'], stripslashes($value));
    					array_push($response['rows'][$i]['cell'], $row['id']);
    					$i++;
    				}
    			}
    		}
    	}
    	return $response;
    }
    /**
     *Get List of City
     *@return  data
     */
    public function getExecutorCities(){
    
    	$response = $this->cache->getItem('get_executor_cities');
    	 
    	if(is_null($response)){
    
    		$data=$this->dbCountry->getExecutorCities()->getArrayResult();
    		 
    		$response=array();
    		foreach($data as $key=>$row) {
    			$response[$key]['id']=$row['id'];
    			$response[$key]['city']=$row['city'];
    		}
    		$this->cache->setItem('get_executor_cities', $response);
    	}
    
    	return $response;
    }
    /**
     *Get List of City
     *@return  data
     */
    public function getRole(){
    
    	$response = $this->cache->getItem('get_user_role');
    
    	if(is_null($response)){
    
    		$data=$this->dbUser->getRole()->getArrayResult();
    		 
    		$response=array();
    		foreach($data as $key=>$row) {    			
    			$response[$key]['id']=$row['id'];
    			$response[$key]['roleRus']=$row['roleRus'];
    		}
    		$this->cache->setItem('get_user_role', $response);
    	}
    
    	return $response;
    }
    /**
     *Validate object
     *@return  true||false
     */
    public function validateNoObjectExist(){
    	$exist=false;
    	if(!is_null($this->data['position'])){
    		switch ($this->data['position']){
    			 case '2': $entityName = $this->dbUser->getEntityUser();	
         				   break;
         		 case '1': $entityName = $this->dbOrganization->getEntityNameOrganization();
         				   break;
    		}
    	}
    	if(!is_null($this->data['name']) && !is_null($this->data['value']) && ($this->data['id']==0)){    		
    		$nameExist= new NoObjectExists(
    			array('object_repository'=>$this->dbUser->getEntityManager()->getRepository($entityName),
    				  'fields' => $this->data['name']));
    		$exist=$nameExist->isValid($this->data['value']);    		
    	}elseif(!empty($this->data['name']) && !empty($this->data['value']) && ($this->data['id']!=0)){
    		$nameExist= new NoObjectExistsNoExclude(
    			array('object_repository'=>$this->dbUser->getEntityManager()->getRepository($entityName),
    				  'fields' => $this->data['name'],
    				  'noexclude'=> array('id'=>$this->data['id'])));
    		$exist=$nameExist->isValid($this->data['value']);
    		
    	}
    	return $exist;
    }
    
    /**
     * Set Query parametrs into the varibles
     *@var Zend\Stdlib\Parameters parametrs
     */
    public function setQueryParametrs(Parameters $parametrs){
    	 
    	$this->page=$parametrs->get('page', '');
    	$this->rows=$parametrs->get('rows', '');    	
    	$this->id=$parametrs->get('id', '');
    	$this->data['filters']=$parametrs->get('filters', null);
    	$this->data['_search']=$parametrs->get('_search', false);
    	$this->data['sidx']=$parametrs->get('sidx', 'id');
    	$this->data['sord']=$parametrs->get('sord', 'asc');
    }
    /**
     * Set Post parametrs into the varibles
     *@var Zend\Stdlib\Parameters parametrs
     */
    public function setPostParametrs(Parameters $parametrs){
    	 
    	$data['name']=$parametrs->get('name', null);
    	$data['nameshort']=$parametrs->get('nameshort', null);
    	$data['nameshorten']=$parametrs->get('nameshorten', null);
    	$data['fullname']=$parametrs->get('fullname', null);
    	$data['fullnameen']=$parametrs->get('fullnameen', null);
    	$data['city']=$parametrs->get('city', null);
    	$data['address']=$parametrs->get('address', null);
    	$data['addressen']=$parametrs->get('addressen', null);
    	$data['phone']=$parametrs->get('phone', null);
    	$data['unp']=$parametrs->get('unp', null);
    	$data['login']=$parametrs->get('login', null);
    	$data['id']=$parametrs->get('id', null);
    	$data['email']=$parametrs->get('email', null);
    	$data['oper']=$parametrs->get('oper', null);
    	$data['executor']=$parametrs->get('executor', null);
    	$data['position']=$parametrs->get('position', null);
    	$data['roleId']=$parametrs->get('roleId', null);
    	$data['roleRus']=$parametrs->get('roleRus', null);
    	$data['phone']=$parametrs->get('phone', null);
    	$data['value']=$parametrs->get('value', null);
    	$data['activate']=$parametrs->get('activate', null);    	
    	$data['datecontract']=$parametrs->get('datecontract', null);
    	$data['contract']=$parametrs->get('contract', null);
    	$data['isresident']=$parametrs->get('sezname', null);
    	$this->data=$data;
    }
    ////////////////////////GET SET Methods//////////////////////////////////////////////////////////////
    /**
     *
     * @return $dbUser
     */
    public function getDbUser(){
    
    	return $this->dbUser;
    }
    /**
     *
     * @param UserService $dbUser
     */
    public function setDbUser(UserService $dbUser){
    
    	$this->dbUser = $dbUser;
    }    
    /**
     *
     * @param OrganizationService $dbOrganization
     */
    public function setDbOrganization(OrganizationService $dbOrganization){
    
    	$this->dbOrganization = $dbOrganization;
    }
    /**
     *
     * @return $Organization
     */
    public function getDbOrganization(){
    
    	return $this->dbOrganization;
    }
    /**
     *Get Options
     *@return options
     */
    public function getOptions()
    {
    	return $this->options;
    }
    /**
     *Set Options
     *@return options
     */
    public function setOptions(GridOptionsInterface $options)
    {
    	$this->options = $options;
    
    	return $this;
    }
    /**
     *
     * @param CountryService $dbCountry
     */
    public function setDbCountry(CountryService $dbCountry){
    
    	$this->dbCountry = $dbCountry;
    }
    /**
     *
     * @return $Country
     */
    public function getDbCountry(){
    
    	return $this->dbCountry;
    }
    /**
     *Get ZfcUserOptions
     *@return zfcUserOptions
     */
    public function getZfcUserOptions()
    {
    	return $this->zfcUserOptions;
    }
    /**
     *Set Options
     *@return options
     */
    public function setzfcUserOptions(ZfcOptions $zfcUserOptions)
    {
    	$this->zfcUserOptions = $zfcUserOptions;
    
    	return $this;
    }
    /**
     *
     */
    public function getAuth(){
    
    	return $this->authUserId;
    }
    /**
     *
     */
    public function setAuth($authUser){
    	//поменять когда будет авторизация
    	$this->authUserId=$authUser;
    }
    /**
     *
     * @param LogService $logger
     */
    public function setLogger(LogService $logger){
    
    	$this->logger = $logger->getLogger();
    }
    /**
     *
     * @return $Logger
     */
    public function getLogger(){
    
    	return $this->logger;
    }
    
    

}


?>