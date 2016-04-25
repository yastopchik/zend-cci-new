<?php

namespace DmnAdmin\Service;

use DmnLog\Service\LogService;
use DmnDatabase\Service\Exception\RuntimeException;

class DmncontentService{      
	/**
	 *
	 * @var $id
	 */	
	protected $id;	
	/**
	 *
	 * @var $dbContent
	 */
	protected $dbContent;	
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
	 *get Content by id
	 * @param $id
	 * @return content
	 */
	public function getContentById(){
	
		return $this->dbContent->getContentById($this->id);
	}
	/**
	 *get Static	
	 * @return content
	 */
	public function getStatic(){
	
		return $this->dbContent->getStatic()->getArrayResult();
	}
	/**
	 *update Content by id
	 * @return $id
	 * @return content
	 */
	public function update(array $data){
	
		return $this->dbContent->updateById($data);
	}
       
    /**   
    ////////////////////////GET SET Methods//////////////////////////////////////////////////////////////
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
     *
     * @return $dbContent
     */
    public function getDbContent(){
    
    	return $this->dbContent;
    }
    /**
     *
     * @param $dbContent
     */
    public function setDbContent($dbContent){
    
    	$this->dbContent = $dbContent;
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