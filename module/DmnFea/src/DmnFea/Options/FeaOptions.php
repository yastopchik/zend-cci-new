<?php 
namespace DmnFea\Options;  

class FeaOptions implements FeaOptionsInterface
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
	protected $emailFromAddress = 'mail@ccimogilev.by';
	/**
	 * @var string
	 */
	protected $emailToAddress = array(0=>'6849444@mail.ru', 1=>'333051@mail.ru');
	/**
	 * @var string
	 */
	protected $emailSubject = 'Заявка на мероприятие';
	/**
	 * @var string
	 */
	protected $emailTemplate = 'dmnfea/dmnfea/feaemail';
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
	public function getEmailToAddress($id)
	{
	   if(is_array($this->emailToAddress)){

	       if(array_key_exists($id, $this->emailToAddress))
	       
	           return $this->emailToAddress[$id];
	       
	   }
	   
	   return $this->emailToAddress;
	}
}
