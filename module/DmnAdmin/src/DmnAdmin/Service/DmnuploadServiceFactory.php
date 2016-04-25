<?php

namespace DmnAdmin\Service;

use DmnAdmin\Options\ExcelOptions;
use DmnAdmin\Options\XmlOptions;

use DmnDatabase\Service\AbstractServiceFactory;

class DmnuploadServiceFactory extends AbstractServiceFactory {

	protected function create() { 
        $uploadService = new DmnuploadService($this->getServiceLocator()->get('cache'));
        $uploadService->setServiceLocator($this->getServiceLocator());
        $uploadService->setDbOrganization($this->getServiceLocator()->get('db_organization'));
        $uploadService->setDirectory($this->getServiceLocator()->get('Config'));
        $uploadService->setRequestService($this->getServiceLocator()->get('dmn_request')); 
        $uploadService->setPrintObject($this->getServiceLocator()->get('print_object'));
        $uploadService->setExcelOptions(new ExcelOptions());
        $uploadService->setXmlOptions(new XmlOptions());
        $uploadService->setAuth($this->getServiceLocator()->get('zfcuser_user_service')->getUserAuthId());        
        $logger=$this->getServiceLocator()->get('logger');
        $logger->openStream('upload');
        $uploadService->setLogger($logger);  
        return $uploadService;		
		
	}

}

?>