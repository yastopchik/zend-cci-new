<?php 
namespace DmnFea\Options;  

interface FeaOptionsInterface  
{
	/**
	 * get attachmentOptions
	 *
	 * @return string
	 */
	public function getAttachmentOptions();
	/**
	 * get Email Subject
	 *
	 * @return string
	 */
	public function getEmailSubject();
	/**
	 * get Email Template
	 *
	 * @return string
	 */	
	public function getEmailTemplate();
	/**
	 * get Email From Address
	 *
	 * @return string
	 */
	public function getEmailFromAddress();
	/**
	 * get Email To Address
	 * @param $id
	 * @return string
	 */	
	public function getEmailToAddress($id);
	
}
