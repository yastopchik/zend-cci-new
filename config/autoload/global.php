<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'db' => array(
        'driver'         => 'Pdo',
        'dsn'            => 'mysql:dbname=ccimogil_evbeltpp;host=localhost',              
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
            PDO::MYSQL_ATTR_LOCAL_INFILE => true,
        	'buffer_results' => true
        ),
        'user'     => 'ccimogil_evtpp',
        'password' => 'c2c4i7m6o0g7il',
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        	'Zend\Cache\StorageFactory' => function() {
        			return Zend\Cache\StorageFactory::factory(
        					array(
        							'adapter' => array(
        									'name' => 'filesystem',        									
        									'options' => array(        											
        											'ttl'=>360,
        											'cacheDir' => 'data/cache',        											
        											'filePermission' => 0666,
        											'namespaceSeparator' => '-0901-',
        									        
        									),
        							       
        							),
        							'plugins' => array('serializer'),
        					)
        			);
        		}
        ),
        'aliases' => array(
        		'cache' => 'Zend\Cache\StorageFactory',
        ),
    ),    
    'directory' => array(
    		'upload' => 'data/upload',
            'fea' => 'data/fea',
    		'log'	 => 'data/log' ,    
    ),
    'module_layouts' => array(
    		'Application_Controller_IndexController' => 'layout/main.phtml', 
    		'Application_Controller_UserController'=>'layout/main.phtml',
    		'Application_Controller_RequestsController' => 'layout/layout.phtml',
    		'DmnAdmin_Controller_DmnRequestController' => 'layout/layout.phtml',
    		'DmnAdmin_Controller_DmnExecutorController' => 'layout/layout.phtml',
    		'DmnAdmin_Controller_DmnUploadController' => 'layout/layout.phtml',
    		'DmnAdmin_Controller_DmnUserController' => 'layout/layout.phtml',
    		'DmnAdmin_Controller_DmnContentController' => 'layout/layout.phtml',
            'DmnAdmin_Controller_DmnStatisticsController' => 'layout/layout.phtml',
    		'DmnExecutor_Controller_DmnExrequestController' => 'layout/layout.phtml',
			'DmnFea_Controller_DmnFeaController' => 'layout/fea.phtml'
    		
    ),
    'mailservice'=>array(    	
    		'transport_class' => 'Zend\Mail\Transport\Smtp',    
    		'options_class' => 'Zend\Mail\Transport\SmtpOptions',    
   			'options' => array(
	    	'host'              => 'ccimogilev.by',
            	'connection_class'  => 'plain',
            	'connection_config' => array(
                	'username' => 'mail@ccimogilev.by',
                	'password' => 'S}A&vnXXPz![',
                	'ssl' => 'ssl'
            ),
			'port' => 465
	  ),
    ),
     
);
