<?php

namespace DmnDatabase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CciUserrole
 *
 * @ORM\Table(name="cci_userrole", uniqueConstraints={@ORM\UniqueConstraint(name="unique_role", columns={"role_id"})}, indexes={@ORM\Index(name="idx_parent_id", columns={"parent_id"})})
 * @ORM\Entity
 */
class CciUserrole
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="role_id", type="string", length=255, nullable=false)
     */
    private $roleId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_default", type="boolean", nullable=false)
     */
    private $isDefault = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="parent_id", type="string", length=255, nullable=true)
     */
    private $parentId;

    /**
     * @var string
     *
     * @ORM\Column(name="role_rus", type="string", length=20, nullable=false)
     */
    private $roleRus;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="DmnDatabase\Entity\CciUser", mappedBy="role")
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set roleId
     *
     * @param string $roleId
     *
     * @return CciUserrole
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;
    
        return $this;
    }

    /**
     * Get roleId
     *
     * @return string
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set isDefault
     *
     * @param boolean $isDefault
     *
     * @return CciUserrole
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;
    
        return $this;
    }

    /**
     * Get isDefault
     *
     * @return boolean
     */
    public function getIsDefault()
    {
        return $this->isDefault;
    }

    /**
     * Set parentId
     *
     * @param string $parentId
     *
     * @return CciUserrole
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    
        return $this;
    }

    /**
     * Get parentId
     *
     * @return string
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set roleRus
     *
     * @param string $roleRus
     *
     * @return CciUserrole
     */
    public function setRoleRus($roleRus)
    {
        $this->roleRus = $roleRus;
    
        return $this;
    }

    /**
     * Get roleRus
     *
     * @return string
     */
    public function getRoleRus()
    {
        return $this->roleRus;
    }

    /**
     * Add user
     *
     * @param \DmnDatabase\Entity\CciUser $user
     *
     * @return CciUserrole
     */
    public function addUser(\DmnDatabase\Entity\CciUser $user)
    {
        $this->user[] = $user;
    
        return $this;
    }

    /**
     * Remove user
     *
     * @param \DmnDatabase\Entity\CciUser $user
     */
    public function removeUser(\DmnDatabase\Entity\CciUser $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }
}
