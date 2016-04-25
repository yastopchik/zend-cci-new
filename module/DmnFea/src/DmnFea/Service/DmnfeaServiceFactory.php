<?php

namespace DmnFea\Service;

use DmnDatabase\Service\AbstractServiceFactory;

class DmnfeaServiceFactory extends AbstractServiceFactory {

	protected function create() { 
        $contentService = new DmnfeaService();  
        $contentService->setConfig($this->getServiceLocator()->get('Config')); 
        $contentService->setMailService($this->getServiceLocator()->get('mailservice_message'));
        $contentService->setFeaOptions($this->getServiceLocator()->get('fea_options'));
        $contentService->setFeaVisitOptions($this->getServiceLocator()->get('fea_visit_options'));
        $contentService->setFeaTranslateOptions($this->getServiceLocator()->get('fea_translate_options'));
		return $contentService;
	}

}

?>