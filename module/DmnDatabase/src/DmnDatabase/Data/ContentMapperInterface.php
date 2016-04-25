<?php

namespace DmnDatabase\Data;

interface ContentMapperInterface {
	
	/**
	 * @return data | NULL
	 */
	public function getContent();
	
	/**
	 * @param integer $priorityId
	 * @return mixed | NULL
	 */
	public function getContentById($id);
	/**	
	 * @param string $static
	 * @return data | NULL
	 */
	public function getContentByStatic($static);
	/**
	 * @param array $data
	 * @return data | NULL
	 */
	public function updateById(array $data);	
	/**	 
	 * @return data | NULL
	 */
	public function getStatic();
}

?>