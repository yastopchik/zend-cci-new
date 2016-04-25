<?php

namespace DmnDatabase\Entity;

use BjyAuthorize\Acl\HierarchicalRoleInterface;
use Doctrine\ORM\Mapping as ORM;


/**
 * Represents a role.
 *
 * @ORM\Entity
 * @ORM\Table(name="cci_userrole")
 *
 */
class CciBjyRole implements HierarchicalRoleInterface
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     * @ORM\Column(name="role_id", type="string", length=255, unique=true, nullable=true)
     */
    private $roleId;    
    
    /**
     * @var Role
     * @ORM\ManyToOne(targetEntity="DmnDatabase\Entity\CciBjyRole")
     */    
    private $parent;
	/**
     * Get the id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the id.
     *
     * @param int $id
     *
     * @return void
     */
    public function setId($id)
    {
        $this->id = (int)$id;
    }

     /**
     * Get the role id.
     *
     * @return string
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set the role id.
     *
     * @param string $roleId
     *
     * @return void
     */
    public function setRoleId($roleId)
    {
        $this->roleId = (string) $roleId;
    }

    /**
     * Get the parent role
     *
     * @return Role
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set the parent role.
     *
     * @param Role $role
     *
     * @return void
     */
    public function setParent(CciBjyRole $parent)
    {
        $this->parent = $parent;
    }
}
