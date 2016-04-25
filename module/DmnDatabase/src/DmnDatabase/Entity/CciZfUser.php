<?php

namespace DmnDatabase\Entity;

use BjyAuthorize\Provider\Role\ProviderInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ZfcUser\Entity\UserInterface;

/**
 * CciUser
 *
 * @ORM\Table(name="cci_user", indexes={@ORM\Index(name="user_to_organization_idx", columns={"OrganizationId"})})
 * @ORM\Entity
 */
class CciZfUser implements UserInterface, ProviderInterface
{
    /**
     * @var integer
     * @ORM\Column(name="Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="Login", type="string", length=50, nullable=false)
     */
    private $username;
    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=75, nullable=false)
     */
    private $email;    
    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=150, nullable=false)
     */
    private $displayName;    
    /**
     * @var string
     *
     * @ORM\Column(name="Password", type="string", length=50, nullable=false)
     */
    private $password;
    /**
     * @var integer
     *
     * @ORM\Column(name="Activate", type="integer", nullable=false)
     */
    private $state;
    /**
     * @var string
     *
     * @ORM\Column(name="NameShort", type="string", length=75, nullable=false)
     */
    private $nameshort;
    /**
     * @var string
     *
     * @ORM\Column(name="Position", type="string", length=50, nullable=true)
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="Phone", type="string", length=75, nullable=false)
     */
    private $phone;    

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateLastVisit", type="date", nullable=false)
     */
    private $datelastvisit;

    /**
     * @var \DmnDatabase\Entity\CciOrganization
     *
     * @ORM\ManyToOne(targetEntity="DmnDatabase\Entity\CciOrganization")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="OrganizationId", referencedColumnName="id")
     * })
     */
    private $organizationid;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @ORM\ManyToMany(targetEntity="DmnDatabase\Entity\CciBjyRole")
     * @ORM\JoinTable(name="cci_userrolelinker",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="Id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     */
    private $role;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->role = new ArrayCollection();
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
     * Set id.
     *
     * @param int $id
     *
     * @return void
     */
    public function setId($id)
    {
    	$this->id = (int) $id;
    }
    /**
     * Set username
     *
     * @param string $username
     *
     * @return void
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
    /**
     * Set email
     *
     * @param string $email
     * @return CciUser
     */
    public function setEmail($email)
    {
    	$this->email = $email;
    
    	return $this;
    }
    
    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
    	return $this->email;
    }
    /**
     * Get displayName.
     *
     * @return string
     */
    public function getDisplayName()
    {
    	return $this->displayName;
    }
    
    /**
     * Set displayName.
     *
     * @param string $displayName
     *
     * @return void
     */
    public function setDisplayName($displayName)
    {
    	$this->displayName = $displayName;
    }   
    /**
     * Set password
     *
     * @param string $password
     * @return CciUser
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * Get state.
     *
     * @return int
     */
    public function getState()
    {
    	return $this->state;
    }
    
    /**
     * Set state.
     *
     * @param int $state
     *
     * @return void
     */
    public function setState($state)
    {
    	$this->state = $state;
    }
    /**
     * Get NameShort
     *
     * @return string
     */
    public function getNameShort()
    {
    	return $this->nameshort;
    }
    /**
     * Set nameshort
     *
     * @param string $nameshort
     * @return CciUser
     */
    public function setNameShort($nameshort)
    {
    	$this->nameshort = $nameshort;
    
    	return $this;
    }
    /**
     * Set position
     *
     * @param string $position
     * @return CciUser
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return CciUser
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }    

    /**
     * Set datelastvisit
     *
     * @param \DateTime $datelastvisit
     * @return CciUser
     */
    public function setDatelastvisit($datelastvisit)
    {
        $this->datelastvisit = $datelastvisit;

        return $this;
    }

    /**
     * Get datelastvisit
     *
     * @return \DateTime 
     */
    public function getDatelastvisit()
    {
        return $this->datelastvisit;
    }

    /**
     * Set organizationid
     *
     * @param \DmnDatabase\Entity\CciOrganization $organizationid
     * @return CciUser
     */
    public function setOrganizationid(\DmnDatabase\Entity\CciOrganization $organizationid = null)
    {
        $this->organizationid = $organizationid;

        return $this;
    }

    /**
     * Get organizationid
     *
     * @return \DmnDatabase\Entity\CciOrganization 
     */
    public function getOrganizationid()
    {
        return $this->organizationid;
    }

    /**
     * Add role
     *
     * @param \DmnDatabase\Entity\CciBjyRole $role
     * @return CciUser
     */
    public function addRole(\DmnDatabase\Entity\CciBjyRole $role)
    {
        $this->role[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \DmnDatabase\Entity\CciBjyRole $role
     */
    public function removeRole(\DmnDatabase\Entity\CciBjyRole $role)
    {
        $this->role->removeElement($role);
    }

    /**
     * Get role
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRole()
    {
        return $this->role;
    }
    /**
     * Get roles.
     *
     * @return array
     */
    public function getRoles()
    {
    	return $this->role->getValues();
    }

    /**
     * Set roleid
     *
     * @param integer $roleid
     * @return CciZfUser
     */
    public function setRoleid($roleid)
    {
        $this->roleid = $roleid;

        return $this;
    }

    /**
     * Get roleid
     *
     * @return integer 
     */
    public function getRoleid()
    {
        return $this->roleid;
    }
}
