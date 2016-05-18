<?php

namespace DmnDatabase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CciXmlUnloadingArchive
 *
 * @ORM\Table(name="cci_xml_unloading_archive")
 * @ORM\Entity
 */
class CciXmlUnloadingArchive
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
     * @var \DmnDatabase\Entity\CciRequestNumberArchive
     *
     * @ORM\ManyToOne(targetEntity="DmnDatabase\Entity\CciRequestNumberArchive")
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
     * @param \DmnDatabase\Entity\CciRequestNumberArchive $sertificatenumid
     *
     * @return CciXmlUnloadingArchive
     */
    public function setSertificatenumid(\DmnDatabase\Entity\CciRequestNumberArchive $sertificatenumid = null)
    {
        $this->sertificatenumid = $sertificatenumid;
    
        return $this;
    }

    /**
     * Get sertificatenumid
     *
     * @return \DmnDatabase\Entity\CciRequestNumberArchive
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
     * @return CciXmlUnloadingArchive
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
