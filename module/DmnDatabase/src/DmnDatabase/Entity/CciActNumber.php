<?php

namespace DmnDatabase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CciActNumber
 *
 * @ORM\Table(name="cci_act_number", indexes={@ORM\Index(name="acts_to_status_idx", columns={"StatusId"}), @ORM\Index(name="acts_to_organization_idx", columns={"OrganizationId"})})
 * @ORM\Entity
 */
class CciActNumber
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
     * @ORM\Column(name="NumAct", type="string", length=45, nullable=true)
     */
    private $numact;

    /**
     * @var string
     *
     * @ORM\Column(name="CountryRule", type="string", length=255, nullable=true)
     */
    private $countryrule;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateAct", type="date", nullable=false)
     */
    private $dateact;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateDuration", type="date", nullable=false)
     */
    private $dateduration;

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
     * @var \DmnDatabase\Entity\CciStatus
     *
     * @ORM\ManyToOne(targetEntity="DmnDatabase\Entity\CciStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="StatusId", referencedColumnName="id")
     * })
     */
    private $statusid;



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
     * Set numact
     *
     * @param string $numact
     *
     * @return CciActNumber
     */
    public function setNumact($numact)
    {
        $this->numact = $numact;

        return $this;
    }

    /**
     * Get numact
     *
     * @return string
     */
    public function getNumact()
    {
        return $this->numact;
    }

    /**
     * Set countryrule
     *
     * @param string $countryrule
     *
     * @return CciActNumber
     */
    public function setCountryrule($countryrule)
    {
        $this->countryrule = $countryrule;

        return $this;
    }

    /**
     * Get countryrule
     *
     * @return string
     */
    public function getCountryrule()
    {
        return $this->countryrule;
    }

    /**
     * Set dateact
     *
     * @param \DateTime $dateact
     *
     * @return CciActNumber
     */
    public function setDateact($dateact)
    {
        $this->dateact = $dateact;

        return $this;
    }

    /**
     * Get dateact
     *
     * @return \DateTime
     */
    public function getDateact()
    {
        return $this->dateact;
    }

    /**
     * Set dateduration
     *
     * @param \DateTime $dateduration
     *
     * @return CciActNumber
     */
    public function setDateduration($dateduration)
    {
        $this->dateduration = $dateduration;

        return $this;
    }

    /**
     * Get dateduration
     *
     * @return \DateTime
     */
    public function getDateduration()
    {
        return $this->dateduration;
    }

    /**
     * Set organizationid
     *
     * @param \DmnDatabase\Entity\CciOrganization $organizationid
     *
     * @return CciActNumber
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
     * Set statusid
     *
     * @param \DmnDatabase\Entity\CciStatus $statusid
     *
     * @return CciActNumber
     */
    public function setStatusid(\DmnDatabase\Entity\CciStatus $statusid = null)
    {
        $this->statusid = $statusid;

        return $this;
    }

    /**
     * Get statusid
     *
     * @return \DmnDatabase\Entity\CciStatus
     */
    public function getStatusid()
    {
        return $this->statusid;
    }
}
