<?php

/**
 * Copyright (c) 2013 Will Hattingh (https://github.com/Nitecon
 *
 * For the full copyright and license information, please view
 * the file LICENSE.txt that was distributed with this source code.
 * 
 * @author Will Hattingh <w.hattingh@nitecon.com>
 *
 * 
 */
return array(
    'zf2-db-session'=>[
        'sessionConfig' => [
            'cache_expire' => 36000,
            //'cookie_domain' => 'localhost',
            'name' => 'request',
            'cookie_lifetime' => 36000,
            'gc_maxlifetime' => 36000,
            'cookie_path' => '/',
            'cookie_secure' => false,//когда включиться https поставить true
            'remember_me_seconds' => 36000,
            'use_cookies' => true,
        ],
        'serviceConfig'=>[
            'base64Encode'=>false
        ]
    ]
);
