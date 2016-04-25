<?php
return array(    
    'controllers' => array(
    	'factories'=>array(
    		'DmnAdmin\Controller\DmnUpload' => 'DmnAdmin\Factory\Controller\DmnuploadControllerServiceFactory',
    		'DmnAdmin\Controller\DmnRequest' => 'DmnAdmin\Factory\Controller\DmnrequestControllerServiceFactory',
    	    'DmnAdmin\Controller\DmnStatistics' => 'DmnAdmin\Factory\Controller\DmnstatisticsControllerServiceFactory',
    		'DmnAdmin\Controller\DmnUser' => 'DmnAdmin\Factory\Controller\DmnuserControllerServiceFactory',
    		'DmnAdmin\Controller\DmnExecutor' => 'DmnAdmin\Factory\Controller\DmnexecutorControllerServiceFactory',
    		'DmnAdmin\Controller\DmnContent' => 'DmnAdmin\Factory\Controller\DmncontentControllerServiceFactory',
       )     		
    ),
	'service_manager' => array(
				'aliases'=>array(
						'dmn_request'     	=> 'DmnAdmin\Service\DmnrequestService',
				        'dmn_statistics'   	=> 'DmnAdmin\Service\DmnstatisticsService',
						'dmn_upload'     	=> 'DmnAdmin\Service\DmnuploadService',
						'dmn_executor'     	=> 'DmnAdmin\Service\DmnexecutorService',
						'dmn_user'     		=> 'DmnAdmin\Service\DmnuserService',
						'dmn_content'     	=> 'DmnAdmin\Service\DmncontentService',
						
				),
				'invokables' => array(					
					'dmn_xml'     				=> 'DmnAdmin\Object\ArrayToXml',
					'print_options_ct1' 		=> 'DmnAdmin\Options\PrintOptionsCT1',
					'print_options_ct2ru' 		=> 'DmnAdmin\Options\PrintOptionsCT2RU',
					'print_options_generalru' 	=> 'DmnAdmin\Options\PrintOptionsGeneralRu',
					'print_options_generalen'	=> 'DmnAdmin\Options\PrintOptionsGeneralEn',
					'print_options_a' 			=> 'DmnAdmin\Options\PrintOptionsA',
					'print_object'  			=> 'DmnAdmin\Object\ExcelToPrint',
				    'print_options_ct2en' 		=> 'DmnAdmin\Options\PrintOptionsCT2EN',
				),
				'factories'=>array(
							
						'DmnAdmin\Service\DmnrequestService'   		 => 'DmnAdmin\Service\DmnrequestServiceFactory',
				        'DmnAdmin\Service\DmnstatisticsService'   	 => 'DmnAdmin\Service\DmnstatisticsServiceFactory',
						'DmnAdmin\Service\DmnuploadService'   		 => 'DmnAdmin\Service\DmnuploadServiceFactory',
						'DmnAdmin\Service\DmnexecutorService'   	 => 'DmnAdmin\Service\DmnexecutorServiceFactory',
						'DmnAdmin\Service\DmnuserService'   	 	 => 'DmnAdmin\Service\DmnuserServiceFactory',
						'DmnAdmin\Service\DmncontentService'   	 	 => 'DmnAdmin\Service\DmncontentServiceFactory',
						'request_session' => function ($sm) {
							return new \DmnAdmin\Storage\Session();
						},
						'sxgeo'     		=> function ($sm) {	
						    return new \DmnAdmin\Object\SxGeo('public/'.'SxGeoCity.dat', SXGEO_BATCH | SXGEO_MEMORY);
						},
						'upload_form' => function ($sm) {
							$form = new \DmnAdmin\Form\UploadForm();
							$form->setInputFilter(new \DmnAdmin\Form\UploadFilter());
							return $form;
						},	
						'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
						/*'add_request_form' => function ($sm) {
						 $db_request = $sm->get('db_request');
						$form = new \DmnAdmin\Form\AddRequestForm($db_request);
						return $form;
						},*/
						)
	),
    'router' => array(
        'routes' => array(
            'dmnrequest' => array('type'    => 'segment',
                'options' => array(
                    'route'    => '/dmnrequest[/:action][/page/:page][/id/:id][/countryId/:countryId]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+', 
                    	'countryId'    => '[0-9]+',
                        'page'     => '[0-9]+',                                        
                    ),
                    'defaults' => array(
                        'controller' => 'DmnAdmin\Controller\DmnRequest',
                        'action'     => 'index', 
                    	'countryId'    => 0,
                        'id' =>0,                                                 
                        'page' =>1                     
                    ),
                ),               
            ), 
        	'dmnupload' => array('type'    => 'segment',
        				'options' => array(
        						'route'    => '/dmnupload[/:action][/id/:id]',
        						'constraints' => array(
        								'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
        								'id'     => '[0-9]+', 
        								'actions'     => '[0-9]+',
        						),
        						'defaults' => array(
        								'controller' => 'DmnAdmin\Controller\DmnUpload',
        								'action'     => 'index',        								
        								'id' =>0, 
        								'actions'     =>0, 
        						),
        				),
        		),
        	'dmnexecutor' => array('type'    => 'segment',
        				'options' => array(
        						'route'    => '/dmnexecutor[/:action][/id/:id]',
        						'constraints' => array(
        								'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
        								'id'     => '[0-9]+',
        								'actions'     => '[0-9]+',
        						),
        						'defaults' => array(
        								'controller' => 'DmnAdmin\Controller\DmnExecutor',
        								'action'     => 'index',
        								'id' =>0,
        								'actions'     =>0,
        						),
        				),
        		),
        	'dmnuser' => array('type'    => 'segment',
        				'options' => array(
        						'route'    => '/dmnuser[/:action][/id/:id]',
        						'constraints' => array(
        								'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
        								'id'     => '[0-9]+',        								
        						),
        						'defaults' => array(
        								'controller' => 'DmnAdmin\Controller\DmnUser',
        								'action'     => 'index',
        								'id' =>0,        								
        						),
        				),
        		),
        	'dmncontent' => array('type'    => 'segment',
        				'options' => array(
        						'route'    => '/dmncontent[/:action][/id/:id]',
        						'constraints' => array(
        								'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
        								'id'     => '[0-9]+',
        						),
        						'defaults' => array(
        								'controller' => 'DmnAdmin\Controller\DmnContent',
        								'action'     => 'index',
        								'id' =>1,
        						),
        				),
        		),
            'dmnstatistics' => array('type'    => 'segment',
                        'options' => array(
                                'route'    => '/dmnstatistics[/:action][/id/:id][/period/:period][/executors/:executors][/forms/:forms][/status/:status][/organization/:organization][/country/:country]',
                                'constraints' => array(
                                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'id'     => '[0-9]+', 
                                        'executors' => '[0-9]+',
                                        'forms' => '[0-9]+',
                                        'status' => '[0-9]+',
                                        'organization'=> '[0-9]+',
                                        'country'=> '[0-9]+'                                      
                                ),
                                'defaults' => array(
                                        'controller' => 'DmnAdmin\Controller\DmnStatistics',
                                        'action'     => 'index',
                                        'period'     => date('Y-m-d'),
                                        'id' =>1,
                                        'executors' => 0,
                                        'forms' => 0,
                                        'status' => 0,
                                        'organization'=> 0,
                                        'country'=> 0
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