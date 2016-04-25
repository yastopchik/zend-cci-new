<?php

namespace DmnDatabase\Data;

interface OrganizationMapperInterface {
	
	/**
	 * @param integer $organizationId	
	 * @return mixed | NULL
	 */
	public function getOrganizationByOrganizationId($statusId);
	/**
	 * @param array $data
	 * @param string $sord
	 * @param string $sordname
	 * @return true | false
	 */
	public function getOrgUsers($search, $sordname, $sord);	
	/**
	 * @param array $data
	 * @return mixed | NULL
	 */
	public function editOrganization($data);
	/**	
	 * @return integer | NULL
	 */
	public function getIscci();
	/**
	 * @param integer iscci	 
	 */
	public function setIscci($iscci);
	/**
	 * @return integer | NULL
	 */
	public function getParentid();
	/**
	 * @param integer parentid
	*/
	public function setParentid($parentid);
	/**	
	 * @return query 
	 */
	public function getSez();
	/**
	 * @return string
	 */
	public function getEntityNameOrganization();
	/**
	 * @param integer $authUserId
	 * @return query | NULL
	 */
	public function getOrgByUserId($authUserId);
}

?>