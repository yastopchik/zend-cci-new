<?php 
namespace Application\Options;  

interface GridOptionsInterface  
{
	/**
	 * get requestNumberOptions
	 *
	 * @return array
	 */
	public function getRequestNumberOptions();
	/**
	 * get requestOptions
	 *
	 * @return array
	 */
	public function getRequestOptions();
	/**
	 * get requestDescriptionOptions
	 *
	 * @return array
	 */
	public function getRequestDescriptionOptions();
	
}
