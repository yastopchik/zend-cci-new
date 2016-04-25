<?php

namespace DmnDatabase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CciOrganization
 *
 * @ORM\Table(name="cci_organization", indexes={@ORM\Index(name="organization_to_city_idx", columns={"CityId"}), @ORM\Index(name="organizationt_to_sez_idx", columns={"IsResident"})})
 * @ORM\Entity
 */
class CciOrganization
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
     * @ORM\Column(name="Name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="FullName", type="string", length=150, nullable=true)
     */
    private $fullname;

    /**
     * @var string
     *
     * @ORM\Column(name="FullNameEn", type="string", length=150, nullable=true)
     */
    private $fullnameen;

    /**
     * @var string
     *
     * @ORM\Column(name="Address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="AddressEn", type="string", length=255, nullable=true)
     */
    private $addressen;

    /**
     * @var string
     *
     * @ORM\Column(name="Phone", type="string", length=45, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="Contract", type="string", length=50, nullable=true)
     */
    private $contract;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateContract", type="date", nullable=true)
     */
    private $datecontract;

    /**
     * @var string
     *
     * @ORM\Column(name="Unp", type="string", length=45, nullable=true)
     */
    private $unp;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IsCci", type="boolean", nullable=false)
     */
    private $iscci = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ParentId", type="integer", nullable=false)
     */
    private $parentid = '0';

    /**
     * @var \DmnDatabase\Entity\CciSez
     *
     * @ORM\ManyToOne(targetEntity="DmnDatabase\Entity\CciSez")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IsResident", referencedColumnName="id")
     * })
     */
    private $isresident;

    /**
     * @var \DmnDatabase\Entity\CciCity
     *
     * @ORM\ManyToOne(targetEntity="DmnDatabase\Entity\CciCity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CityId", referencedColumnName="id")
     * })
     */
    private $cityid;



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
     * Set name
     *
     * @param string $name
     *
     * @return CciOrganization
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
     * Set fullname
     *
     * @param string $fullname
     *
     * @return CciOrganization
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
    
        return $this;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set fullnameen
     *
     * @param string $fullnameen
     *
     * @return CciOrganization
     */
    public function setFullnameen($fullnameen)
    {
        $this->fullnameen = $fullnameen;
    
        return $this;
    }

    /**
     * Get fullnameen
     *
     * @return string
     */
    public function getFullnameen()
    {
        return $this->fullnameen;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return CciOrganization
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set addressen
     *
     * @param string $addressen
     *
     * @return CciOrganization
     */
    public function setAddressen($addressen)
    {
        $this->addressen = $addressen;
    
        return $this;
    }

    /**
     * Get addressen
     *
     * @return string
     */
    public function getAddressen()
    {
        return $this->addressen;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return CciOrganization
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
     * Set contract
     *
     * @param string $contract
     *
     * @return CciOrganization
     */
    public function setContract($contract)
    {
        $this->contract = $contract;
    
        return $this;
    }

    /**
     * Get contract
     *
     * @return string
     */
    public function getContract()
    {
        return $this->contract;
    }

    /**
     * Set datecontract
     *
     * @param \DateTime $datecontract
     *
     * @return CciOrganization
     */
    public function setDatecontract($datecontract)
    {
        $this->datecontract = $datecontract;
    
        return $this;
    }

    /**
     * Get datecontract
     *
     * @return \DateTime
     */
    public function getDatecontract()
    {
        return $this->datecontract;
    }

    /**
     * Set unp
     *
     * @param string $unp
     *
     * @return CciOrganization
     */
    public function setUnp($unp)
    {
        $this->unp = $unp;
    
        return $this;
    }

    /**
     * Get unp
     *
     * @return string
     */
    public function getUnp()
    {
        return $this->unp;
    }

    /**
     * Set iscci
     *
     * @param boolean $iscci
     *
     * @return CciOrganization
     */
    public function setIscci($iscci)
    {
        $this->iscci = $iscci;
    
        return $this;
    }

    /**
     * Get iscci
     *
     * @return boolean
     */
    public function getIscci()
    {
        return $this->iscci;
    }

    /**
     * Set parentid
     *
     * @param integer $parentid
     *
     * @return CciOrganization
     */
    public function setParentid($parentid)
    {
        $this->parentid = $parentid;
    
        return $this;
    }

    /**
     * Get parentid
     *
     * @return integer
     */
    public function getParentid()
    {
        return $this->parentid;
    }

    /**
     * Set isresident
     *
     * @param \DmnDatabase\Entity\CciSez $isresident
     *
     * @return CciOrganization
     */
    public function setIsresident(\DmnDatabase\Entity\CciSez $isresident = null)
    {
        $this->isresident = $isresident;
    
        return $this;
    }

    /**
     * Get isresident
     *
     * @return \DmnDatabase\Entity\CciSez
     */
    public function getIsresident()
    {
        return $this->isresident;
    }

    /**
     * Set cityid
     *
     * @param \DmnDatabase\Entity\CciCity $cityid
     *
     * @return CciOrganization
     */
    public function setCityid(\DmnDatabase\Entity\CciCity $cityid = null)
    {
        $this->cityid = $cityid;
    
        return $this;
    }

    /**
     * Get cityid
     *
     * @return \DmnDatabase\Entity\CciCity
     */
    public function getCityid()
    {
        return $this->cityid;
    }
}
