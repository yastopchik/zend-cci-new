<?php
namespace DmnMail\Mail\Service;

use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\Mail\Message as MailMessage;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Zend\Mime\Mime;

class Message implements ServiceManagerAwareInterface {

    /**
     *
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     *
     * @param ServiceManager $serviceManager
     * @return AbstractService
     */
    public function setServiceManager(ServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    /**
     *
     * @return ServiceManager
     */
    public function getServiceManager() {
        return $this->serviceManager;
    }

    /**
     *
     * @var \Zend\View\Renderer\RendererInterface
     */
    protected $renderer;

    /**
     *
     * @var \Zend\Mail\Transport\TransportInterface
     */
    protected $transport;
    /**
     *
     * @var attachment
     */
    protected $attachment;
    /**
     *Get attachment
     *@return config
     */
    public function getAttachment()
    {
        return $this->attachment;
    }
    /**
     *Set Attachment
     *@return attachment
     */
    public function setAttachment($attachment)
    {
        $this->attachment[] = $attachment;
    
        return $this;
    }

    /**
     * Return a HTML message ready to be sent
     *
     * @param array|string $from
     *            A string containing the sender e-mail address, or if array with keys email and name
     * @param array|string $to
     *            An array containing the recipients of the mail
     * @param string $subject
     *            Subject of the mail
     * @param string|\Zend\View\Model\ModelInterface $nameOrModel
     *            Either the template to use, or a ViewModel
     * @param null|array $values
     *            Values to use when the template is rendered
     * @return Message
     */
    public function createHtmlMessage($from, $to, $subject, $nameOrModel, $values = array()) {
        $renderer = $this->getRenderer();
        $content = $renderer->render($nameOrModel, $values);

        $text = new MimePart('');
        $text->type = Mime::TYPE_TEXT;
        $text->encoding    = Mime::ENCODING_BASE64;
        $text->charset='UTF-8';

        $html = new MimePart($content);
        $html->type = Mime::TYPE_HTML;
        $html->encoding    = Mime::ENCODING_BASE64;
        $html->charset='UTF-8';

        $body = new MimeMessage();
        $parts=array($text, $html);
        foreach($this->attachment as $key=>$value){
            if($value instanceof MimePart)
               array_push($parts, $value); 
        }  
        $body->setParts($parts);

        return $this->getDefaultMessage($from, 'UTF-8', $to, $subject, $body);
    }

    /**
     * Return a text message ready to be sent
     *
     * @param array|string $from
     *            A string containing the sender e-mail address, or if array with keys email and name
     * @param array|string $to
     *            An array containing the recipients of the mail
     * @param string $subject
     *            Subject of the mail
     * @param string|\Zend\View\Model\ModelInterface $nameOrModel
     *            Either the template to use, or a ViewModel
     * @param null|array $values
     *            Values to use when the template is rendered
     * @return Message
     */
    public function createTextMessage($from, $to, $subject, $nameOrModel, $values = array()) {
        $renderer = $this->getRenderer();
        $content = $renderer->render($nameOrModel, $values);

        return $this->getDefaultMessage($from, 'UTF-8', $to, $subject, $content);
    }

    /**
     * Send the message
     *
     * @param Message $message
     */
    public function send(MailMessage $message) {
        $this->getTransport()
            ->send($message);
    }

    /**
     * Get the renderer
     *
     * @return \Zend\View\Renderer\RendererInterface
     */
    protected function getRenderer() {
        if($this->renderer === null) {
            $serviceManager = $this->getServiceManager();
            $this->renderer = $serviceManager->get('mailservice_renderer');
        }

        return $this->renderer;
    }

    /**
     * Get the transport
     *
     * @return \Zend\Mail\Transport\TransportInterface
     */
    protected function getTransport() {
        if($this->transport === null) {
            $this->transport = $this->getServiceManager()
                ->get('mailservice_transport');
        }

        return $this->transport;
    }

    /**
     *
     * @return Message
     */
    protected function getDefaultMessage($from, $encoding, $to, $subject, $body) {
        if(is_string($from)) {
            $from = array('email' => $from, 'name' => $from);
        }

        $message = new MailMessage();
        $message->setFrom($from['email'], $from['name'])
            ->setEncoding($encoding)
            ->setSubject($subject)
            ->setBody($body)
            ->setTo($to);

        return $message;
    }
}