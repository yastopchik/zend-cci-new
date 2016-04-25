<?php

namespace DmnDatabase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CciXmlUnloading
 *
 * @ORM\Table(name="cci_xml_unloading")
 * @ORM\Entity
 */
class CciXmlUnloading
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
     * @var \DmnDatabase\Entity\CciRequestNumber
     *
     * @ORM\ManyToOne(targetEntity="DmnDatabase\Entity\CciRequestNumber")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="SertificateNumID", referencedColumnName="Id")
     * })
     */
    private $sertificatenumid;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateUnloading", type="date", nullable=false)
     */
    private $dateunloading;


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
     * Set sertificatenumid
     *
     * @param \DmnDatabase\Entity\CciRequestNumber $sertificatenumid
     *
     * @return CciXmlUnloading
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
    /**
     * Set dateunloading
     *
     * @param \DateTime $dateunloading
     *
     * @return CciXmlUnloading
     */
    public function setDateunloading($dateunloading)
    {
        $this->dateunloading = $dateunloading;
    
        return $this;
    }
    
    /**
     * Get dateunloading
     *
     * @return \DateTime
     */
    public function getDateunloading()
    {
        return $this->dateunloading;
    }
}
