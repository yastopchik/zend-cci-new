<?php

namespace DmnAdmin\Service;

use DmnDatabase\Service\AbstractServiceFactory;

class DmncontentServiceFactory extends AbstractServiceFactory {

	protected function create() { 
        $contentService = new DmncontentService();  
        $contentService->setDbContent($this->getServiceLocator()->get('db_content'));       
        $contentService->setAuth($this->getServiceLocator()->get('zfcuser_user_service')->getUserAuthId());
        $logger=$this->getServiceLocator()->get('logger');
        $logger->openStream('content');
        $contentService->setLogger($logger);
               
		return $contentService;
	}

}

?>