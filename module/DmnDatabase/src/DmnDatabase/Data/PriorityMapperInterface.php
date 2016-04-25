<?php

namespace DmnDatabase\Data;

interface PriorityMapperInterface {
	
	/**
	 * @param integer $priorityId	
	 * @return mixed | NULL
	 */
	public function getPriorityByPriorityId($priorityId);
	/**
	 * @return data | NULL
	 */
	public function getPriorities();
	
}

?>