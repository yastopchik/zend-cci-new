<?php

namespace DmnDatabase\Data;

interface UserMapperInterface {	
	
	/**	  
	 * @param $orgId
	 * @return mixed | NULL
	 */
	public function  getUserNameByOrgId($orgId);	
	/**
	 * @param $id
	 * @return query
	 */
	public function getUserById($id);
	
	/**
	 * @param UserId
	 * @return Distributorid
	 */
	public function getDistributorsByUserId($userId);
	
	/**
	 * @param array
	 * @return true | false
	 */
	public function editUser(array $data);
	/**
	 * @param array
	 * @return true | false
	 */
	public function addUser(array $data);
	/**
	 * @param array
	 * @return true | false
	 */
	public function getRole();
	/**
	 * @return integer | NULL
	 */
	public function getIscci();
	/**
	 * @param integer iscci
	*/
	public function setIscci($iscci);
	
	
}

?>