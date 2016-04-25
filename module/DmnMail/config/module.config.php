<?php
return array(
    'mailservice' => array(
        'transport_class' => 'Zend\Mail\Transport\Sendmail'
    ),
    'service_manager' => array(
        'shared' => array(
            'mailservice_message' => false
        ),
        'invokables' => array(
            'mailservice_message'   => 'DmnMail\Mail\Service\Message',
            'mail_options' 		    => 'DmnMail\Mail\Options\MailOptions',
            'mail_listener'         => 'DmnMail\Mail\Listener\MailEventsListener'
        ),
        'factories' => array(
            'mailservice_transport' => 'DmnMail\Mail\Transport\Service\TransportFactory',
            'mailservice_renderer'  => 'DmnMail\Mail\View\MailPhpRendererFactory',
        ),
    )
);