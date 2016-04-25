<?php

namespace DmnDatabase\Service;

use DmnDatabase\Service\AbstractServiceFactory;

class UserServiceFactory extends AbstractServiceFactory {

	protected function create() { 
        $service = new UserService($this->getServiceLocator()->get('DmnDatabase\Data\UserMapper'), $this->getServiceLocator()->get('cache'));
        
		return $service;
	}

}

?>