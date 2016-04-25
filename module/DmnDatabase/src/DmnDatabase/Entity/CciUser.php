<?php

namespace DmnDatabase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CciUser
 *
 * @ORM\Table(name="cci_user", indexes={@ORM\Index(name="user_to_organization_idx", columns={"OrganizationId"})})
 * @ORM\Entity
 */
class CciUser
{
    /**
     * @var integer
     *
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
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="Password", type="string", length=128, nullable=false)
     */
    private $password;

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
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="NameShort", type="string", length=75, nullable=false)
     */
    private $nameshort;

    /**
     * @var string
     *
     * @ORM\Column(name="NameShortEn", type="string", length=75, nullable=false)
     */
    private $nameshorten;

    /**
     * @var string
     *
     * @ORM\Column(name="Position", type="string", length=200, nullable=true)
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="Phone", type="string", length=75, nullable=false)
     */
    private $phone;

    /**
     * @var integer
     *
     * @ORM\Column(name="Activate", type="integer", nullable=false)
     */
    private $activate;

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
     *
     * @ORM\ManyToMany(targetEntity="DmnDatabase\Entity\CciUserrole", inversedBy="user")
     * @ORM\JoinTable(name="cci_userrolelinker",
     *   joinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="Id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     *   }
     * )
     */
    private $role;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->role = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set login
     *
     * @param string $login
     *
     * @return CciUser
     */
    public function setLogin($login)
    {
        $this->login = $login;
    
        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     *
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
     * Set email
     *
     * @param string $email
     *
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
     * Set name
     *
     * @param string $name
     *
     * @return CciUser
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set nameshort
     *
     * @param string $nameshort
     *
     * @return CciUser
     */
    public function setNameshort($nameshort)
    {
        $this->nameshort = $nameshort;
    
        return $this;
    }

    /**
     * Get nameshort
     *
     * @return string
     */
    public function getNameshort()
    {
        return $this->nameshort;
    }

    /**
     * Set nameshorten
     *
     * @param string $nameshorten
     *
     * @return CciUser
     */
    public function setNameshorten($nameshorten)
    {
        $this->nameshorten = $nameshorten;
    
        return $this;
    }

    /**
     * Get nameshorten
     *
     * @return string
     */
    public function getNameshorten()
    {
        return $this->nameshorten;
    }

    /**
     * Set position
     *
     * @param string $position
     *
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
     *
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
     * Set activate
     *
     * @param integer $activate
     *
     * @return CciUser
     */
    public function setActivate($activate)
    {
        $this->activate = $activate;
    
        return $this;
    }

    /**
     * Get activate
     *
     * @return integer
     */
    public function getActivate()
    {
        return $this->activate;
    }

    /**
     * Set datelastvisit
     *
     * @param \DateTime $datelastvisit
     *
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
     *
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
     * @param \DmnDatabase\Entity\CciUserrole $role
     *
     * @return CciUser
     */
    public function addRole(\DmnDatabase\Entity\CciUserrole $role)
    {
        $this->role[] = $role;
    
        return $this;
    }

    /**
     * Remove role
     *
     * @param \DmnDatabase\Entity\CciUserrole $role
     */
    public function removeRole(\DmnDatabase\Entity\CciUserrole $role)
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
}
