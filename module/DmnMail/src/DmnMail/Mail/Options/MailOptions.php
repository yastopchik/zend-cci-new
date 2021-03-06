<?php
namespace DmnMail\Mail\Options;

class MailOptions implements MailOptionsInterface
{
	/**
	 * @var array
	 */
	protected $attachmentOptions = array(				
			             'type'  =>'application/vnd.ms-word',
						 'encoding '=>'ENCODING_BASE64',
						 'disposition'=>'DISPOSITION_ATTACHMENT',					               
			
	);
	/**
	 * @var string
	 */
	protected $emailFromAddress = 'mail@info.of.by';
	/**
	 * @var string
	 */
	protected $emailFromName = 'УП Могилевское отделение БелТПП';
	/**
	 * @var string
	 */
	protected $emailToAddress = array();
	/**
	 * @var string
	 */
	protected $emailSubject = 'Заявка на получение сертификата.';
	/**
	 * @var string
	 */
	protected $emailTemplate = 'dmnadmin/dmnrequest/mail';
	/**
	 * get attacment options
	 *
	 * @return array
	 */	
	public function getAttachmentOptions()
	{
		return $this->requestNumberOptions;
	}	
	public function getEmailSubject() 
	{
	    return $this->emailSubject;
	}
	public function getEmailTemplate() 
	{
	    return $this->emailTemplate;
	}
	public function getEmailFromAddress() 
	{
	    return $this->emailFromAddress;
	}
	public function getEmailFromName()
	{
		return $this->emailFromName;
	}
	public function getEmailToAddress($id)
	{
	   if(is_array($this->emailToAddress)){

	       if(array_key_exists($id, $this->emailToAddress))
	       
	           return $this->emailToAddress[$id];
	       
	   }
	   
	   return $this->emailToAddress;
	}
}
