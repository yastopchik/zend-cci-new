<?php 
namespace DmnFea\Options;  

class FeaTranslateOptions implements FeaTranslateOptionsInterface
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
	protected $emailToAddress = array(0=>'perevod.mogilev@gmail.com');
	/**
	 * @var string
	 */
	protected $emailSubject = 'Заявка на перевод';
	/**
	 * @var string
	 */
	protected $emailTemplate = 'dmnfea/dmnfea/featranslateemail';
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
