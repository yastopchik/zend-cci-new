<?php
return array(
	'bjyauthorize' => array(

		'default_role' => 'guest',
		'identity_provider' => 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider',   
		//'authenticated_role' => 'Клиент',
		 'role_providers' => array(
			// this will load roles from
			// the 'BjyAuthorize\Provider\Role\ObjectRepositoryProvider' service
			'BjyAuthorize\Provider\Role\ObjectRepositoryProvider' => array(
				'object_manager'    => 'doctrine.entitymanager.orm_default',
				'role_entity_class' => 'DmnDatabase\Entity\CciBjyRole',
			),
		),       
		'guards' => array(          
		'BjyAuthorize\Guard\Controller' => array(  
			array('controller' => 'zfcuser', 'roles' => array()),
			//array('controller' => 'zfcuser/forgotpassword',  'roles' => array('guest')),
		    array('controller' => 'zfcuser/changepassword',  'roles' => array('user', 'admin', 'distributer', 'executor')),
			array('controller' => 'zfcuser/logout',  'roles' => array('user', 'admin', 'distributer', 'executor')),
            array('controller' => 'Application\Controller\Index',  'roles' => array('guest', 'user', 'admin', 'distributer', 'executor')),
			array('controller' => 'Application\Controller\User',  'roles' => array('guest', 'user', 'admin', 'distributer', 'executor')),
			array('controller' => 'DmnFea\Controller\DmnFea',  'roles' => array('guest', 'user')),
			array('controller' => 'Application\Controller\Requests',  'roles' => array('user')),
			array('controller' => 'Application\Controller\Acts',  'roles' => array('user')),
			array('controller' => 'DmnAdmin\Controller\DmnRequest',  'roles' => array('admin', 'distributer')),
			array('controller' => 'DmnAdmin\Controller\DmnRequest', 'action' => array('archreq'), 'roles' => array('guest', 'user', 'admin', 'distributer', 'executor')),
			array('controller' => 'DmnAdmin\Controller\DmnExecutor',  'roles' => array('admin', 'distributer')),
			array('controller' => 'DmnAdmin\Controller\DmnUpload', 'action' => array('downloadxml', 'downloadprint', 'downloadxls', 'index'), 'roles' => array('admin', 'distributer')),
		    array('controller' => 'DmnAdmin\Controller\DmnUpload', 'action' => array('uploadxml', 'reqxml'), 'roles' => array('guest', 'user', 'admin', 'distributer', 'executor')),
			array('controller' => 'DmnAdmin\Controller\DmnUser',  'roles' => array('admin', 'distributer')),
			array('controller' => 'DmnAdmin\Controller\DmnContent',  'roles' => array('admin', 'distributer')),
			array('controller' => 'DmnAdmin\Controller\DmnAct',  'roles' => array('admin', 'distributer')),
			array('controller' => 'DmnExecutor\Controller\DmnExrequest',  'roles' => array('executor')),
			array('controller' => 'DmnExecutor\Controller\DmnExacts',  'roles' => array('executor')),
		    array('controller' => 'DmnAdmin\Controller\DmnStatistics',  'roles' => array('user', 'admin', 'distributer', 'executor')),
			), 
		),         
		// strategy service name for the strategy listener to be used when permission-related errors are detected
	'unauthorized_strategy' => 'BjyAuthorize\View\UnauthorizedStrategy',

	// Template name for the unauthorized strategy
	'template_map' => array(
		'error/403' => '/application/error/403.phtml',
	),
		
	),
);