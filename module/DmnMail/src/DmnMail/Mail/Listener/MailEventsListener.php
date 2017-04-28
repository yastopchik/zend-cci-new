<?php

namespace DmnMail\Mail\Listener;

use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
//use Zend\ServiceManager\ServiceLocatorAwareInterface;

use DmnMail\Mail\Options\MailOptions;
use DmnMail\Mail\Service\Message as MailService;

class MailEventsListener implements ListenerAggregateInterface//, ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;
    /**
     * @var MailService
     */
    protected $mailService;
    /**
     * @var MailOptions
     */
    protected $mailoptions;

    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = array();

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $sharedEvents = $events->getSharedManager();
        $this->listeners[] = $sharedEvents->attach('DmnAdmin\Service\DmnrequestService', 'send_mail', array($this, 'onSendMail'), 100);
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    /**
     * @return MailService
     */
    public function getMailService()
    {
        if (!$this->mailService) {
            $this->mailService = $this->getServiceLocator()->get('mailservice_message');
        }

        return $this->mailService;
    }

    /**
     * @param MailService $mailService
     */
    public function setMailService(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    /**
     * @return MailOptions
     */
    public function getMailOptions()
    {
        if (!$this->mailoptions) {
            $this->mailoptions = $this->getServiceLocator()->get('mail_options');
        }
        return $this->mailoptions;
    }

    /**
     * @param MailOptions $mailOptions
     */
    public function setMailOptions(MailOptions $mailOptions)
    {
        $this->mailoptions = $mailOptions;
    }

    public function onSendMail(EventInterface $e)
    {
        $data = $e->getParams();
        if (is_array($data) && count($data) != 0) {
            $mailService = $this->getMailService();
            $mailOptions = $this->getMailOptions();
            foreach ($data as $key => $value) {
                $mailService->send($mailService->createHtmlMessage(
                    ['email'=>$mailOptions->getEmailFromAddress(), 'name'=>$mailOptions->getEmailFromName()], $value['useremail'],
                    $mailOptions->getEmailSubject(),
                    $mailOptions->getEmailTemplate(), $value));
            }
        }
    }
}