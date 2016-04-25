<?php
return array(    
    'controllers' => array(
    	'factories'=>array(    		
    		'DmnExecutor\Controller\DmnExrequest' => 'DmnExecutor\Factory\Controller\DmnexrequestControllerServiceFactory',    		
       )     		
    ),
	'service_manager' => array(
				'aliases'=>array(
						'dmn_exrequest'     	=> 'DmnExecutor\Service\DmnexrequestService',
				),				
				'factories'=>array(
							
						'DmnExecutor\Service\DmnexrequestService'   		 => 'DmnExecutor\Service\DmnexrequestServiceFactory',									
						'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',						
						)
	),
    'router' => array(
        'routes' => array(
            'dmnexrequest' => array('type'    => 'segment',
                'options' => array(
                    'route'    => '/dmnexrequest[/:action][/page/:page][/id/:id][/countryId/:countryId]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+', 
                    	'countryId'    => '[0-9]+',
                        'page'     => '[0-9]+',                                        
                    ),
                    'defaults' => array(
                        'controller' => 'DmnExecutor\Controller\DmnExrequest',
                        'action'     => 'index', 
                    	'countryId'    => 0,
                        'id' =>0,                                                 
                        'page' =>1                     
                    ),
                ),               
            ),         	
        ),
    ),	
	'translator' => array(
				'locale' => 'ru_RU',
				'translation_file_patterns' => array(
						array(
								'type'     => 'gettext',
								'base_dir' => __DIR__ . '/../language',
								'pattern'  => '%s.mo',
						),
				),
	),
    'view_manager' => array( 
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),        
    ),
);