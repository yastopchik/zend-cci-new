<?php

namespace DmnDatabase\Data;

interface LifecycleMapperInterface {
	
	/**
	 * @param integer $requestId	
	 * @return data | NULL
	 */
	public function getLifecycleByRequestId($requestId);
	
	
}

?>