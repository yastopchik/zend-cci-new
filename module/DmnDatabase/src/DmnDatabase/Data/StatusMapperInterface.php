<?php

namespace DmnDatabase\Data;

interface StatusMapperInterface {
	
	/**
	 * @param integer $statusId	
	 * @return mixed | NULL
	 */
	public function getStatusByStatusId($statusId);
	/**
	 * @return data | NULL
	 */
	public function getStatuses();
	
	
}

?>