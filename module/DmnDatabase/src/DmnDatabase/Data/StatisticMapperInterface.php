<?php

namespace DmnDatabase\Data;

interface StatisticMapperInterface {
	
	/**
	 * @param integer $statisticId	
	 * @return mixed | NULL
	 */
	public function getStatisticByStatisticId($statisticId);
	/* ------------------Statistics-------------------------*/
	/**
	 * View Count of request by Forms
	 * @param array $period
	 * @return query
	 */
	public function getCountOfRequestByForms(array $period);
	/**
	 * View Sum of request by Clients
	 *  @param array $period
	 * @return query
	*/
	public function getCountOfRequestByClients(array $period);
	/**
	 * View Count of request by Executors
	 *  @param array $period
	 * @return query
	*/
	public function getCountOfRequestByExecutors(array $period);
	/**
	 * View Count of request by Stataus
	 *  @param array $period
	 * @return query
	 */
	public function getCountOfRequestByStatus(array $period);
	/**
	 * View Count of request by Country
	 *  @param array $period
	 * @return query
	 */
	public function getCountOfRequestByCountry(array $period);
	
	
}

?>