<?php
use DmnDatabase\Data\RequestMapper;
use DmnDatabase\Data\StatusMapper;
use DmnDatabase\Data\PriorityMapper;
use DmnDatabase\Data\OrganizationMapper;
use DmnDatabase\Data\LifecycleMapper;
use DmnDatabase\Data\StatisticMapper;
use DmnDatabase\Data\UserMapper;
use DmnDatabase\Data\CountryMapper;
use DmnDatabase\Data\ContentMapper;
use DmnDatabase\Data\ActMapper;
use DmnDatabase\Data\FormsMapper;

return array(    
		'doctrine' => array(
				'driver' => array(
						'db_entities' => array(
								'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
								'cache' => 'array',
								'paths' => array(__DIR__ . '/../../DmnDatabase/src/DmnDatabase/Entity')
						),
						'orm_default' => array(
								'drivers' => array(
										'DmnDatabase\Entity' => 'db_entities'
								)
						)
				 ),						
		),
		
       'service_manager' => array(
               'aliases'=>array(
                       'db_request'     	=> 'DmnDatabase\Service\RequestService',
                       'db_status'      	=> 'DmnDatabase\Service\StatusService',
                       'db_lifecycle'   	=> 'DmnDatabase\Service\LifecycleService',
               		   'db_organization'    => 'DmnDatabase\Service\OrganizationService',
               		   'db_priority'        => 'DmnDatabase\Service\PriorityService',
               		   'db_statistic'       => 'DmnDatabase\Service\StatisticService',
               		   'db_user'            => 'DmnDatabase\Service\UserService',
               		   'db_country'         => 'DmnDatabase\Service\CountryService',
               		   'db_content'         => 'DmnDatabase\Service\ContentService',
               		   'db_act'             => 'DmnDatabase\Service\ActService',
                       'db_forms'           => 'DmnDatabase\Service\FormsService',
               ),
               'factories'=>array(               			              		
                       'DmnDatabase\Service\RequestService'   		 => 'DmnDatabase\Service\RequestServiceFactory',
                       'DmnDatabase\Service\StatusService'    		 => 'DmnDatabase\Service\StatusServiceFactory',
                       'DmnDatabase\Service\LifecycleService'  		 => 'DmnDatabase\Service\LifecycleServiceFactory',
               		   'DmnDatabase\Service\OrganizationService'     => 'DmnDatabase\Service\OrganizationServiceFactory',
               		   'DmnDatabase\Service\PriorityService'         => 'DmnDatabase\Service\PriorityServiceFactory',
               		   'DmnDatabase\Service\StatisticService'        => 'DmnDatabase\Service\StatisticServiceFactory',
               		   'DmnDatabase\Service\UserService'        	 => 'DmnDatabase\Service\UserServiceFactory',
               		   'DmnDatabase\Service\CountryService'        	 => 'DmnDatabase\Service\CountryServiceFactory',
               		   'DmnDatabase\Service\ContentService'        	 => 'DmnDatabase\Service\ContentServiceFactory',
               		   'DmnDatabase\Service\ActService'        	     => 'DmnDatabase\Service\ActServiceFactory',
                       'DmnDatabase\Service\FormsService'        	 => 'DmnDatabase\Service\FormsServiceFactory',
               		    
               		   'DmnDatabase\Data\UserMapper' => function ($sm) {
               			return new UserMapper($sm->get('doctrine.entitymanager.orm_default'), $sm);
               			},
               		   'DmnDatabase\Data\StatisticMapper' => function ($sm) {
               			return new StatisticMapper($sm->get('doctrine.entitymanager.orm_default'), $sm);
               			},
               		   'DmnDatabase\Data\PriorityMapper' => function ($sm) {
               			return new PriorityMapper($sm->get('doctrine.entitymanager.orm_default'), $sm);
               		    },
               		   'DmnDatabase\Data\OrganizationMapper' => function ($sm) {
               			return new OrganizationMapper($sm->get('doctrine.entitymanager.orm_default'), $sm);
                    	},                       
                       'DmnDatabase\Data\StatusMapper' => function ($sm) {
                   	        return new StatusMapper($sm->get('doctrine.entitymanager.orm_default'), $sm);
                   	    },
                       'DmnDatabase\Data\RequestMapper' => function ($sm) {
                   	        return new RequestMapper($sm->get('doctrine.entitymanager.orm_default'), $sm);
                        },
                       'DmnDatabase\Data\LifecycleMapper' => function ($sm) {
                        	return new LifecycleMapper($sm->get('doctrine.entitymanager.orm_default'), $sm);
                        },
                        'DmnDatabase\Data\CountryMapper' => function ($sm) {
                        	return new CountryMapper($sm->get('doctrine.entitymanager.orm_default'), $sm);
                        },
                        'DmnDatabase\Data\ContentMapper' => function ($sm) {
                        	return new ContentMapper($sm->get('doctrine.entitymanager.orm_default'), $sm);
                        },
				        'DmnDatabase\Data\ActMapper' => function ($sm) {
					       return new ActMapper($sm->get('doctrine.entitymanager.orm_default'), $sm);
				        },
                        'DmnDatabase\Data\FormsMapper' => function ($sm) {
                            return new FormsMapper($sm->get('doctrine.entitymanager.orm_default'), $sm);                            
                        },
                        'zfcuser_module_options' => function ($sm) {
                        	$config = $sm->get('Configuration');
                        	return new \DmnDatabase\Options\ModuleOptions(isset($config['zfcuser']) ? $config['zfcuser'] : array());
                        },
                        'zfcuser_user_mapper' => function ($sm) {
                        	$mapper = new \DmnDatabase\Mapper\User($sm->get('doctrine.entitymanager.orm_default'), $sm->get('zfcuser_module_options'));
                        	return $mapper;
                        },                        
               ),
		   'invokables' => array(
	           'Zend\Authentication\AuthenticationService' => 'Zend\Authentication\AuthenticationService',
            ),
       ),
        
		
);
