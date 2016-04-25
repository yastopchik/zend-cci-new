<?php

namespace DmnAdmin\Service;

use DmnDatabase\Service\AbstractServiceFactory;
use DmnAdmin\Options\GridOptions;


class DmnuserServiceFactory extends AbstractServiceFactory {

	protected function create() { 
	    $userService = new DmnuserService($this->getServiceLocator()->get('cache'));
        $userService->setDbUser($this->getServiceLocator()->get('db_user'));
        $userService->setDbOrganization($this->getServiceLocator()->get('db_organization'));
        $userService->setDbCountry($this->getServiceLocator()->get('db_country'));
        $userService->setZfcUserOptions($this->getServiceLocator()->get('zfcuser_module_options'));
        $userService->setAuth($this->getServiceLocator()->get('zfcuser_user_service')->getUserAuthId());
        $userService->setOptions(new GridOptions());
        $logger=$this->getServiceLocator()->get('logger');
        $logger->openStream('user');
        $userService->setLogger($logger);
               
		return $userService;
	}

}

?>