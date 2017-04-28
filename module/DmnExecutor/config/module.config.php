<?php
return array(    
    'controllers' => array(
    	'factories'=>array(    		
    		'DmnExecutor\Controller\DmnExrequest' => 'DmnExecutor\Factory\Controller\DmnexrequestControllerServiceFactory',
			'DmnExecutor\Controller\DmnExacts' => 'DmnExecutor\Factory\Controller\DmnexactsControllerServiceFactory',
       )     		
    ),
	'service_manager' => array(
				'aliases'=>array(
						'dmn_exrequest'     	=> 'DmnExecutor\Service\DmnexrequestService',
						'dmn_exacts'     	=> 'DmnExecutor\Service\DmnactsService',
				),
				'factories'=>array(
							
						'DmnExecutor\Service\DmnexrequestService'   		 => 'DmnExecutor\Service\DmnexrequestServiceFactory',									
						'DmnExecutor\Service\DmnactsService'   		 => 'DmnExecutor\Service\DmnexactsServiceFactory',									
						'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',						
						)
	),
    'router' => array(
        'routes' => array(
            'dmnexrequest' => array('type'    => 'segment',
                'options' => array(
                    'route'    => '/dmnexrequest[/:action][/page/:page][/id/:id][/isarch/:isarch][/countryId/:countryId]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+', 
                    	'countryId'    => '[0-9]+',
                        'isarch'=>'[0-9]',
                        'page'     => '[0-9]+',                                        
                    ),
                    'defaults' => array(
                        'controller' => 'DmnExecutor\Controller\DmnExrequest',
                        'action'     => 'index', 
                    	'countryId'    => 0,
                        'id' =>0,
                        'isarch' => 0,
                        'page' =>1                     
                    ),
                ),               
            ),
			'dmnexact' => array('type'    => 'segment',
				'options' => array(
					'route'    => '/dmnexact[/:action][/page/:page][/id/:id][/isarch/:isarch][/countryId/:countryId]',
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id'     => '[0-9]+',
						'countryId'    => '[0-9]+',
						'isarch'=>'[0-9]',
						'page'     => '[0-9]+',
					),
					'defaults' => array(
						'controller' => 'DmnExecutor\Controller\DmnExacts',
						'action'     => 'index',
						'id'     => 0,
						'countryId'    => 0,
						'isarch' => 0,
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