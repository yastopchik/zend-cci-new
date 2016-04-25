<?php

namespace DmnDatabase\Data;

interface CountryMapperInterface {
	
	/**
	 * @return data | NULL
	 */
	public function getCountries();
	
	/**
	 * @param integer $priorityId
	 * @return mixed | NULL
	 */
	public function getCountryById($id);
	/**	
	 * @return data | NULL
	 */
	public function getExecutorCities();
}

?>