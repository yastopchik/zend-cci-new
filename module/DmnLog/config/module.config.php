<?php
return array(  
    'service_manager' => array(
        'aliases'=>array(						
						'logger'     		=> 'DmnLog\Service\LogService',
				),
				'factories'=>array(							
						'DmnLog\Service\LogService'   		 => 'DmnLog\Service\LogServiceFactory',
				)
    ),    
);
