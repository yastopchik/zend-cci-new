<?php

namespace DmnDatabase\Data;

interface FormsMapperInterface {
	
	/**
	 * @param integer $id	
	 * @return mixed | NULL
	 */
	public function getFormsById($id);
	/**
	 * @return data | NULL
	 */
	public function getForms();
	
}

?>