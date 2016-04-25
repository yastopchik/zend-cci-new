<?php
return array(
    'modules' => array(
    	'ZfcBase',
    	'ZfcUser',
    	'BjyAuthorize',
    	'BjyProfiler',
        'Application',
    	'DmnAdmin',
    	'DmnExecutor',
        'DmnDatabase', 
        'DmnFea', 
    	'DmnLog',
    	'DmnMail',
        'DoctrineModule',
        'DoctrineORMModule',
    	'DBSessionStorage',
    		
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            './module',
            './vendor',
        ),
    ),
);
