<?php

namespace DmnDatabase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CciRequestArchive
 *
 * @ORM\Table(name="cci_request_archive", indexes={@ORM\Index(name="sertificate_to_sertificatenum_idx", columns={"SertificateNumID"})})
 * @ORM\Entity
 */
class CciRequestArchive
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
     * @ORM\Column(name="Consignor", type="string", length=150, nullable=false)
     */
    private $consignor;

    /**
     * @var string
     *
     * @ORM\Column(name="Exporter", type="string", length=150, nullable=true)
     */
    private $exporter;

    /**
     * @var string
     *
     * @ORM\Column(name="Consignee", type="string", length=150, nullable=false)
     */
    private $consignee;

    /**
     * @var string
     *
     * @ORM\Column(name="Importer", type="string", length=150, nullable=true)
     */
    private $importer;

    /**
     * @var string
     *
     * @ORM\Column(name="Transport", type="string", length=75, nullable=true)
     */
    private $transport;

    /**
     * @var string
     *
     * @ORM\Column(name="ServiceMark", type="string", length=150, nullable=true)
     */
    private $servicemark;

    /**
     * @var string
     *
     * @ORM\Column(name="AdressConsignor", type="string", length=255, nullable=false)
     */
    private $adressconsignor;

    /**
     * @var string
     *
     * @ORM\Column(name="AdressExporter", type="string", length=255, nullable=true)
     */
    private $adressexporter;

    /**
     * @var string
     *
     * @ORM\Column(name="AdressConsignee", type="string", length=255, nullable=false)
     */
    private $adressconsignee;

    /**
     * @var string
     *
     * @ORM\Column(name="AdressImporter", type="string", length=255, nullable=true)
     */
    private $adressimporter;

    /**
     * @var string
     *
     * @ORM\Column(name="Itinerary", type="string", length=175, nullable=true)
     */
    private $itinerary;

    /**
     * @var string
     *
     * @ORM\Column(name="UnpConsignor", type="string", length=9, nullable=false)
     */
    private $unpconsignor;

    /**
     * @var string
     *
     * @ORM\Column(name="UnpExporter", type="string", length=9, nullable=true)
     */
    private $unpexporter;

    /**
     * @var string
     *
     * @ORM\Column(name="Representation", type="string", length=255, nullable=false)
     */
    private $representation;

    /**
     * @var string
     *
     * @ORM\Column(name="FioAgent", type="string", length=150, nullable=false)
     */
    private $fioagent;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set consignor
     *
     * @param string $consignor
     *
     * @return CciRequestArchive
     */
    public function setConsignor($consignor)
    {
        $this->consignor = $consignor;
    
        return $this;
    }

    /**
     * Get consignor
     *
     * @return string
     */
    public function getConsignor()
    {
        return $this->consignor;
    }

    /**
     * Set exporter
     *
     * @param string $exporter
     *
     * @return CciRequestArchive
     */
    public function setExporter($exporter)
    {
        $this->exporter = $exporter;
    
        return $this;
    }

    /**
     * Get exporter
     *
     * @return string
     */
    public function getExporter()
    {
        return $this->exporter;
    }

    /**
     * Set consignee
     *
     * @param string $consignee
     *
     * @return CciRequestArchive
     */
    public function setConsignee($consignee)
    {
        $this->consignee = $consignee;
    
        return $this;
    }

    /**
     * Get consignee
     *
     * @return string
     */
    public function getConsignee()
    {
        return $this->consignee;
    }

    /**
     * Set importer
     *
     * @param string $importer
     *
     * @return CciRequestArchive
     */
    public function setImporter($importer)
    {
        $this->importer = $importer;
    
        return $this;
    }

    /**
     * Get importer
     *
     * @return string
     */
    public function getImporter()
    {
        return $this->importer;
    }

    /**
     * Set transport
     *
     * @param string $transport
     *
     * @return CciRequestArchive
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;
    
        return $this;
    }

    /**
     * Get transport
     *
     * @return string
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * Set servicemark
     *
     * @param string $servicemark
     *
     * @return CciRequestArchive
     */
    public function setServicemark($servicemark)
    {
        $this->servicemark = $servicemark;
    
        return $this;
    }

    /**
     * Get servicemark
     *
     * @return string
     */
    public function getServicemark()
    {
        return $this->servicemark;
    }

    /**
     * Set adressconsignor
     *
     * @param string $adressconsignor
     *
     * @return CciRequestArchive
     */
    public function setAdressconsignor($adressconsignor)
    {
        $this->adressconsignor = $adressconsignor;
    
        return $this;
    }

    /**
     * Get adressconsignor
     *
     * @return string
     */
    public function getAdressconsignor()
    {
        return $this->adressconsignor;
    }

    /**
     * Set adressexporter
     *
     * @param string $adressexporter
     *
     * @return CciRequestArchive
     */
    public function setAdressexporter($adressexporter)
    {
        $this->adressexporter = $adressexporter;
    
        return $this;
    }

    /**
     * Get adressexporter
     *
     * @return string
     */
    public function getAdressexporter()
    {
        return $this->adressexporter;
    }

    /**
     * Set adressconsignee
     *
     * @param string $adressconsignee
     *
     * @return CciRequestArchive
     */
    public function setAdressconsignee($adressconsignee)
    {
        $this->adressconsignee = $adressconsignee;
    
        return $this;
    }

    /**
     * Get adressconsignee
     *
     * @return string
     */
    public function getAdressconsignee()
    {
        return $this->adressconsignee;
    }

    /**
     * Set adressimporter
     *
     * @param string $adressimporter
     *
     * @return CciRequestArchive
     */
    public function setAdressimporter($adressimporter)
    {
        $this->adressimporter = $adressimporter;
    
        return $this;
    }

    /**
     * Get adressimporter
     *
     * @return string
     */
    public function getAdressimporter()
    {
        return $this->adressimporter;
    }

    /**
     * Set itinerary
     *
     * @param string $itinerary
     *
     * @return CciRequestArchive
     */
    public function setItinerary($itinerary)
    {
        $this->itinerary = $itinerary;
    
        return $this;
    }

    /**
     * Get itinerary
     *
     * @return string
     */
    public function getItinerary()
    {
        return $this->itinerary;
    }

    /**
     * Set unpconsignor
     *
     * @param string $unpconsignor
     *
     * @return CciRequestArchive
     */
    public function setUnpconsignor($unpconsignor)
    {
        $this->unpconsignor = $unpconsignor;
    
        return $this;
    }

    /**
     * Get unpconsignor
     *
     * @return string
     */
    public function getUnpconsignor()
    {
        return $this->unpconsignor;
    }

    /**
     * Set unpexporter
     *
     * @param string $unpexporter
     *
     * @return CciRequestArchive
     */
    public function setUnpexporter($unpexporter)
    {
        $this->unpexporter = $unpexporter;
    
        return $this;
    }

    /**
     * Get unpexporter
     *
     * @return string
     */
    public function getUnpexporter()
    {
        return $this->unpexporter;
    }

    /**
     * Set representation
     *
     * @param string $representation
     *
     * @return CciRequestArchive
     */
    public function setRepresentation($representation)
    {
        $this->representation = $representation;
    
        return $this;
    }

    /**
     * Get representation
     *
     * @return string
     */
    public function getRepresentation()
    {
        return $this->representation;
    }

    /**
     * Set fioagent
     *
     * @param string $fioagent
     *
     * @return CciRequestArchive
     */
    public function setFioagent($fioagent)
    {
        $this->fioagent = $fioagent;
    
        return $this;
    }

    /**
     * Get fioagent
     *
     * @return string
     */
    public function getFioagent()
    {
        return $this->fioagent;
    }

    /**
     * Set sertificatenumid
     *
     * @param \DmnDatabase\Entity\CciRequestNumberArchive $sertificatenumid
     *
     * @return CciRequestArchive
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
}
