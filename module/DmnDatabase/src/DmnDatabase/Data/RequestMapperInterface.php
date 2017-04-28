<?php

namespace DmnDatabase\Data;

interface RequestMapperInterface {

	/**
	 * @param $entityName
	 * @return mixed
	 */
	public function __get($entityName);
	/**
	 * @param $entityName
	 * @param $entityValue
	 * @return mixed
	 */
	public function __set($entityName, $entityValue);
	/**
	 * @param integer $requestId	
	 * @return mixed | NULL
	 */
	public function getRequestByRequestId($requestId);
	/**
	 * @param DateTime beginDate
	 * @param DateTime endDate
	 * @return query | NULL
	 */	
	public function getRequestNumbersByDate($beginDate, $endDate);
	/**
	 * @param Array value
	 * @param DateTime date
	 * @return query | NULL
	 */
	public function fillXmlUnloading($value, $date);
	/**
	 * @param DateTime date
	 * @return query | NULL
	 */
	public function requestToArchive($date);
	/**
	 * @param Array status	
	 * @return query | NULL
	 */
	public function getRequestNumbersByStatus(array $staus);
	/**		  
	 * @return mixed | NULL
	 */
	public function getRequestNumber($search);
	/**
	 * @param integer $requestId
	 * @return mixed | NULL
	 */
	public function getRequestNumberById($requestId);	
	/**
	 * @param integer $requestId
	 * @return mixed | NULL
	 */
	public function getRequestDescriptionByRequestId($requestId);
	/**
	 * @param integer $requestId
	 * @return mixed | NULL
	 */
	public function getRequsetWorkOrder($requestId);
	/**
	 * @param integer $requestId
	 * @return mixed | NULL
	 */
	//public function getCountryByRequestId($requestId);
	/**
	 * @param integer $Id
	 * @return mixed | NULL
	 */
	public function getCountryById($requestId);
	/**
	 * @param string $nameru
	 * @return mixed | NULL
	 */	
	public function getCountryByNameRu($nameru);
	
	/**
	 * @param array $data, integer $statusid
	 * @return true | false
	 */
	public function updateRequestNumber(array $data, $statusid);
	/**
	 * @param array $data
	 * @return true | false
	 */
	public function updateRequestDescription(array $data);
	/**
	 * @param array $data
	 * @return true | false
	 */
	public function updateRequest(array $data);
	/**
	 * @param array $data
	 * @return true | false
	 */
	public function addRequest(array $data);	
	/**
	 * @return statusid
	 */	
	public function getStatusByRequestId($id);	
	
	/**
	 * @return query
	 */
	public function getDistributerCityByUserId();

	public function setYear($year);

	public function getYear();
}
