<?php
return array(
    'controllers' => array(
    	'factories'=>array(
    		'DmnFea\Controller\DmnFea' => 'DmnFea\Factory\Controller\DmnfeaControllerServiceFactory',    		
       )     		
    ),
    'service_manager' => array(               
                'aliases' => array(
                    'dmn_fea'     				    => 'DmnFea\Service\DmnfeaService',                        
                ),
                'factories'=>array(                    	
                    'DmnFea\Service\DmnfeaService'  => 'DmnFea\Service\DmnfeaServiceFactory'
                ),
                'invokables' => array(                   
                    'fea_options' 		            => 'DmnFea\Options\FeaOptions',
                    'fea_visit_options'             => 'DmnFea\Options\FeaVisitOptions',
                    'fea_translate_options'         => 'DmnFea\Options\FeaTranslateOptions',
                )
    ),
     'router' => array(
                'routes' => array(
                        'fea' => array('type'    => 'segment',
                                'options' => array(
                                        'route'    => '/fea[/:action][/page/:page][/visa/:visa][/url/:url][/id/:id]',
                                        'constraints' => array(
                                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                'url'    => '[a-zA-Z0-9_-]*',
                                                'visa'    => '[a-zA-Z0-9_-]*',
                                                'id'     => '[0-9]+',
                                                'page'     => '[0-9]+',
                                        ),
                                        'defaults' => array(
                                                'controller' => 'DmnFea\Controller\DmnFea',
                                                'action'     => 'index',
                                                'id' =>0,
                                                'page' =>1,
                                                'url'    => '',
                                                'visa'    =>0,
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