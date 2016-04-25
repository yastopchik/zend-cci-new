<?php 
namespace DmnAdmin\Options;  

interface XmlOptionsInterface  
{
	/**
	 * get requestNumberOptions
	 *
	 * @return string
	 */
	public function getRequestNumberOptions();
	/**
	 * get requestOptions
	 *
	 * @return string
	 */
	public function getRequestOptions();
	/**
	 * get requestDescriptionOptions
	 *
	 * @return string
	 */
	public function getRequestDescriptionOptions();
	/**
	 * get additionalValues
	 *
	 * @return string
	 */
	public function getAdditionalValues();
	/**
	 * get getConvertSeveralRequestValues
	 *
	 * @return string
	 */
	public function getConvertSeveralRequestValues();
}
