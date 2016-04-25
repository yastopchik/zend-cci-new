<?php
return array(
	'controllers' => array(
				'factories' => array(
					'Application\Controller\Requests' => 'Application\Factory\Controller\RequestsControllerServiceFactory',
					'Application\Controller\Index' => 'Application\Factory\Controller\IndexControllerServiceFactory',
						
					'zfcuser' => function($controllerManager) {
							/* @var ControllerManager $controllerManager*/
							$serviceManager = $controllerManager->getServiceLocator();
						
							/* @var RedirectCallback $redirectCallback */
							$redirectCallback = $serviceManager->get('zfcuser_redirect_callback');
						
							/* @var UserController $controller */
							$controller = new \Application\Controller\UserController($redirectCallback);
						
							return $controller;
					},						
				),								
	),
	'service_manager' => array(
				'aliases'=>array(
						'requests'     	=> 'Application\Service\RequestsService',						
				),
				'factories' => array(
						'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
						'application_auth' => function ($sm) {
							$authorize = $sm->get('BjyAuthorize\Provider\Identity\ProviderInterface');							
							return $authorize->getIdentityRoles();
						},	
						'identity_auth' => function ($sm) {
							$identity = $sm->get('zfcuser_auth_service');
							return $identity;
						},
						'Application\Service\RequestsService' => 'Application\Service\RequestsServiceFactory',
						
				),
				'invokables'=>array(
						'zfcuser_user_service'              => 'Application\Service\User',
				)
	),
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array('type'    => 'segment',
                'options' => array(
                    'route'    => '/application[/:action][/id/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',  
                        'book'     => '[0-9]+',                                                                                                                   
                    ), 
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',                                                                      
                        'id' =>1,  
                                                                                                                 
                    ),
                ),               
            ),
            'requests' => array('type'    => 'segment',
                'options' => array(
                    'route'    => '/requests[/:action][/page/:page][/id/:id][/countryId/:countryId]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',  
                        'id'     => '[0-9]+',
                    	'countryId'    => '[0-9]+',
                    	'page'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Requests',
                        'action'     => 'index',  
                        'id'     => 0,    
                    	'countryId'    => 0,
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
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'XHTML1_STRICT',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
        	'header2'                => __DIR__ . '/../view/layout/header2.phtml',
        	'header3'                => __DIR__ . '/../view/layout/header3.phtml',
            'header4'                => __DIR__ . '/../view/layout/header4.phtml',
        	'header5'                => __DIR__ . '/../view/layout/header5.phtml',        	
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        	'error/403'               => __DIR__ . '/../view/error/403.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
