<?php

namespace DmnDatabase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CciRequestDescriptionArchive
 *
 * @ORM\Table(name="cci_request_description_archive", indexes={@ORM\Index(name="sertificatedescription_to_sertificate_idx", columns={"SertificateID"})})
 * @ORM\Entity
 */
class CciRequestDescriptionArchive
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
     * @ORM\Column(name="Paragraph", type="string", length=5, nullable=true)
     */
    private $paragraph;

    /**
     * @var string
     *
     * @ORM\Column(name="Seats", type="string", length=150, nullable=true)
     */
    private $seats;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="HsCode", type="string", length=15, nullable=true)
     */
    private $hscode;

    /**
     * @var string
     *
     * @ORM\Column(name="Quantity", type="string", length=50, nullable=true)
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="Unit", type="string", length=50, nullable=true)
     */
    private $unit;

    /**
     * @var string
     *
     * @ORM\Column(name="Invoce", type="string", length=50, nullable=true)
     */
    private $invoce;

    /**
     * @var \DmnDatabase\Entity\CciRequestArchive
     *
     * @ORM\ManyToOne(targetEntity="DmnDatabase\Entity\CciRequestArchive")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="SertificateID", referencedColumnName="Id")
     * })
     */
    private $sertificateid;



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
     * Set paragraph
     *
     * @param string $paragraph
     *
     * @return CciRequestDescriptionArchive
     */
    public function setParagraph($paragraph)
    {
        $this->paragraph = $paragraph;
    
        return $this;
    }

    /**
     * Get paragraph
     *
     * @return string
     */
    public function getParagraph()
    {
        return $this->paragraph;
    }

    /**
     * Set seats
     *
     * @param string $seats
     *
     * @return CciRequestDescriptionArchive
     */
    public function setSeats($seats)
    {
        $this->seats = $seats;
    
        return $this;
    }

    /**
     * Get seats
     *
     * @return string
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return CciRequestDescriptionArchive
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set hscode
     *
     * @param string $hscode
     *
     * @return CciRequestDescriptionArchive
     */
    public function setHscode($hscode)
    {
        $this->hscode = $hscode;
    
        return $this;
    }

    /**
     * Get hscode
     *
     * @return string
     */
    public function getHscode()
    {
        return $this->hscode;
    }

    /**
     * Set quantity
     *
     * @param string $quantity
     *
     * @return CciRequestDescriptionArchive
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    
        return $this;
    }

    /**
     * Get quantity
     *
     * @return string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set unit
     *
     * @param string $unit
     *
     * @return CciRequestDescriptionArchive
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    
        return $this;
    }

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set invoce
     *
     * @param string $invoce
     *
     * @return CciRequestDescriptionArchive
     */
    public function setInvoce($invoce)
    {
        $this->invoce = $invoce;
    
        return $this;
    }

    /**
     * Get invoce
     *
     * @return string
     */
    public function getInvoce()
    {
        return $this->invoce;
    }

    /**
     * Set sertificateid
     *
     * @param \DmnDatabase\Entity\CciRequestArchive $sertificateid
     *
     * @return CciRequestDescriptionArchive
     */
    public function setSertificateid(\DmnDatabase\Entity\CciRequestArchive $sertificateid = null)
    {
        $this->sertificateid = $sertificateid;
    
        return $this;
    }

    /**
     * Get sertificateid
     *
     * @return \DmnDatabase\Entity\CciRequestArchive
     */
    public function getSertificateid()
    {
        return $this->sertificateid;
    }
}
