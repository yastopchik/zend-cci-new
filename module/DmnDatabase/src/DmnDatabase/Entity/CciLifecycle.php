<?php

namespace DmnDatabase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CciLifecycle
 *
 * @ORM\Table(name="cci_lifecycle", indexes={@ORM\Index(name="lifecycle_to_requestNum_idx", columns={"SertificateNumID"})})
 * @ORM\Entity
 */
class CciLifecycle
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
     * @var \DateTime
     *
     * @ORM\Column(name="Acceped", type="datetime", nullable=false)
     */
    private $acceped;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Working", type="datetime", nullable=true)
     */
    private $working;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Issuance", type="datetime", nullable=true)
     */
    private $issuance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Proceed", type="datetime", nullable=true)
     */
    private $proceed;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Duplicate", type="datetime", nullable=true)
     */
    private $duplicate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Exchange", type="datetime", nullable=true)
     */
    private $exchange;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Notindemand", type="datetime", nullable=true)
     */
    private $notindemand;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Damaged", type="datetime", nullable=true)
     */
    private $damaged;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Suspended", type="datetime", nullable=true)
     */
    private $suspended;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Nodocuments", type="datetime", nullable=true)
     */
    private $nodocuments;

    /**
     * @var \DmnDatabase\Entity\CciRequestNumber
     *
     * @ORM\ManyToOne(targetEntity="DmnDatabase\Entity\CciRequestNumber")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="SertificateNumID", referencedColumnName="Id")
     * })
     */
    private $sertificatenumid;



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
     * Set acceped
     *
     * @param \DateTime $acceped
     *
     * @return CciLifecycle
     */
    public function setAcceped($acceped)
    {
        $this->acceped = $acceped;
    
        return $this;
    }

    /**
     * Get acceped
     *
     * @return \DateTime
     */
    public function getAcceped()
    {
        return $this->acceped;
    }

    /**
     * Set working
     *
     * @param \DateTime $working
     *
     * @return CciLifecycle
     */
    public function setWorking($working)
    {
        $this->working = $working;
    
        return $this;
    }

    /**
     * Get working
     *
     * @return \DateTime
     */
    public function getWorking()
    {
        return $this->working;
    }

    /**
     * Set issuance
     *
     * @param \DateTime $issuance
     *
     * @return CciLifecycle
     */
    public function setIssuance($issuance)
    {
        $this->issuance = $issuance;
    
        return $this;
    }

    /**
     * Get issuance
     *
     * @return \DateTime
     */
    public function getIssuance()
    {
        return $this->issuance;
    }

    /**
     * Set proceed
     *
     * @param \DateTime $proceed
     *
     * @return CciLifecycle
     */
    public function setProceed($proceed)
    {
        $this->proceed = $proceed;
    
        return $this;
    }

    /**
     * Get proceed
     *
     * @return \DateTime
     */
    public function getProceed()
    {
        return $this->proceed;
    }

    /**
     * Set duplicate
     *
     * @param \DateTime $duplicate
     *
     * @return CciLifecycle
     */
    public function setDuplicate($duplicate)
    {
        $this->duplicate = $duplicate;
    
        return $this;
    }

    /**
     * Get duplicate
     *
     * @return \DateTime
     */
    public function getDuplicate()
    {
        return $this->duplicate;
    }

    /**
     * Set exchange
     *
     * @param \DateTime $exchange
     *
     * @return CciLifecycle
     */
    public function setExchange($exchange)
    {
        $this->exchange = $exchange;
    
        return $this;
    }

    /**
     * Get exchange
     *
     * @return \DateTime
     */
    public function getExchange()
    {
        return $this->exchange;
    }

    /**
     * Set notindemand
     *
     * @param \DateTime $notindemand
     *
     * @return CciLifecycle
     */
    public function setNotindemand($notindemand)
    {
        $this->notindemand = $notindemand;
    
        return $this;
    }

    /**
     * Get notindemand
     *
     * @return \DateTime
     */
    public function getNotindemand()
    {
        return $this->notindemand;
    }

    /**
     * Set damaged
     *
     * @param \DateTime $damaged
     *
     * @return CciLifecycle
     */
    public function setDamaged($damaged)
    {
        $this->damaged = $damaged;
    
        return $this;
    }

    /**
     * Get damaged
     *
     * @return \DateTime
     */
    public function getDamaged()
    {
        return $this->damaged;
    }

    /**
     * Set suspended
     *
     * @param \DateTime $suspended
     *
     * @return CciLifecycle
     */
    public function setSuspended($suspended)
    {
        $this->suspended = $suspended;
    
        return $this;
    }

    /**
     * Get suspended
     *
     * @return \DateTime
     */
    public function getSuspended()
    {
        return $this->suspended;
    }

    /**
     * Set nodocuments
     *
     * @param \DateTime $nodocuments
     *
     * @return CciLifecycle
     */
    public function setNodocuments($nodocuments)
    {
        $this->nodocuments = $nodocuments;
    
        return $this;
    }

    /**
     * Get nodocuments
     *
     * @return \DateTime
     */
    public function getNodocuments()
    {
        return $this->nodocuments;
    }

    /**
     * Set sertificatenumid
     *
     * @param \DmnDatabase\Entity\CciRequestNumber $sertificatenumid
     *
     * @return CciLifecycle
     */
    public function setSertificatenumid(\DmnDatabase\Entity\CciRequestNumber $sertificatenumid = null)
    {
        $this->sertificatenumid = $sertificatenumid;
    
        return $this;
    }

    /**
     * Get sertificatenumid
     *
     * @return \DmnDatabase\Entity\CciRequestNumber
     */
    public function getSertificatenumid()
    {
        return $this->sertificatenumid;
    }
}
