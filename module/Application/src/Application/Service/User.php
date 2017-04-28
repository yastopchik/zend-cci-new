<?php

namespace Application\Service;

use ZfcUser\Service\User as ZfcUserService;
use BjyAuthorize\Provider\Role\ProviderInterface as RoleProviderInterface;

class User extends ZfcUserService
{
	/**	 
	 * @param int
	 */
	protected $defineRole;	
	/**
	 * @param int
	 */
	protected $identity;
	/**
	 * @param int
	 */
	protected $userAuthId;
	/**
	 * define redirect route by $defineRole
	 *
	 * @return int
	 */
	public function getRedirectRoute(){

		if (null === $this->defineRole) {
			$this->defineRole=$this->setDefineRole();
		}		
		//get options zfc
		$loginRedirectRoute=$this->getOptions()->getLoginRedirectRoute();
		
		if(is_array($loginRedirectRoute)){
			
			if(array_key_exists($this->defineRole, $loginRedirectRoute)){
				
				$loginRedirectRoute=$loginRedirectRoute[$this->defineRole];
			}
			
		}
		return $loginRedirectRoute;
	}
	/**
	 * get $identity
	 * @return RoleProviderInterface identity
	 */
	public function getAuthIdentity(){
	
		if (null === $this->identity) {
			$this->identity=$this->setAuthIdentity();
		}
		return $this->identity;
	}
	/**
	 * set $identity RoleProviderInterface
	 */
	public function setAuthIdentity(){
	
		$identity = $this->getAuthService()->getIdentity();
	
		if ($identity instanceof RoleProviderInterface) {
			$this->identity=$identity;
		}
		return $this->identity;
	}
	
	/**
	 * get $userAuthId
	 * @return int
	 */
	public function getUserAuthId(){		
		
		if (null === $this->userAuthId && null!==$this->getAuthIdentity()) {
			
			$this->userAuthId=$this->getAuthIdentity()->getId();
		}
		return $this->userAuthId;
	}
	/**
	 * get $defineRole
	 * @return int
	 */
	public function getDefineRole(){
		
		if (null === $this->defineRole) {			
			$this->defineRole=$this->setDefineRole();			
		}	
		return $this->defineRole;
	} 
	/**
	 * set $defineRole from BjyAuthorize\Provider\Identity\ProviderInterface
	 *
	 * @return int
	 */
	public function setDefineRole(){

		$auth=$this->getServiceManager()->get('applicationauth');
		
		foreach($auth as $key=>$value){
			if($value instanceof \DmnDatabase\Entity\CciBjyRole){
				$this->defineRole=$value->getId();
			}else{
				$this->defineRole=1;
			}
		}
		return $this->defineRole;
	}
}
