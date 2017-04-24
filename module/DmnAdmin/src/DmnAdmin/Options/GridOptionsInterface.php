<?php 
namespace DmnAdmin\Options;  

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
	/**
	 * get orgExecutorOptions
	 *
	 * @return array
	 */
	public function getOrgExecutorOptions();
	/**
	 * get ExecutorOptions
	 *
	 * @return array
	 */
	public function getExecutorOptions();
	/**
	 * get orgUserOptions
	 *
	 * @return string
	 */
	public function getOrgUserOptions();
	/**
	 * get orgUserOptions
	 *
	 * @return string
	 */
	public function getUserOptions();
	/**
	 * get ActOptions
	 *
	 * @return string
	 */
	public function getActOptions();
	/**
	 * get ActOptions
	 *
	 * @return string
	 */
	public function getActNumberOptions();
}
