<?php

namespace Application\Service;


use DmnAdmin\Service\DmnrequestService;
use DmnAdmin\Service\DmnuploadService;
use Zend\Cache\Storage\Adapter\Filesystem;
use Application\Options\GridOptionsInterface;

class RequestsService extends DmnrequestService{ 	
  
	
	/**
	 *
	 * @var $uploadService
	 */
	protected $uploadService;
    /**    
    * @param Zend\Cache\Storage\Adapter\Filesystem $cache
    */
    public function __construct(Filesystem $cache)
    {
    	parent::__construct($cache);
    }     
    /**
     *Set Options
     *@return options
     */
    public function setApplicationOptions(GridOptionsInterface $options)
    {
    	$this->options = $options;
    
    	return $this;
    }  
    /**
     *Get DmnuploadService Service
     *@return uploadServices
     */
    public function getUploadService()
    {
    	return $this->uploadService;
    }
    /**
     *Set DmnuploadService Service
     *@return uploadServices
     */
    public function setUploadService(DmnuploadService $uploadService)
    {
    	$this->uploadService = $uploadService;
    
    	return $this;
    }  
    

}

?>