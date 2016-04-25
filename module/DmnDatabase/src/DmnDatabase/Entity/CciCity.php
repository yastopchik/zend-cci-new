<?php

namespace DmnDatabase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CciCity
 *
 * @ORM\Table(name="cci_city", indexes={@ORM\Index(name="city_to_region_idx", columns={"idregion"}), @ORM\Index(name="city_to_country_idx", columns={"idcountry"})})
 * @ORM\Entity
 */
class CciCity
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
     * @ORM\Column(name="nameru", type="string", length=150, nullable=true)
     */
    private $nameru;

    /**
     * @var string
     *
     * @ORM\Column(name="nameen", type="string", length=150, nullable=true)
     */
    private $nameen;

    /**
     * @var \DmnDatabase\Entity\CciCountry
     *
     * @ORM\ManyToOne(targetEntity="DmnDatabase\Entity\CciCountry")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idcountry", referencedColumnName="id")
     * })
     */
    private $idcountry;

    /**
     * @var \DmnDatabase\Entity\CciRegion
     *
     * @ORM\ManyToOne(targetEntity="DmnDatabase\Entity\CciRegion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idregion", referencedColumnName="id")
     * })
     */
    private $idregion;



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
     * Set nameru
     *
     * @param string $nameru
     *
     * @return CciCity
     */
    public function setNameru($nameru)
    {
        $this->nameru = $nameru;
    
        return $this;
    }

    /**
     * Get nameru
     *
     * @return string
     */
    public function getNameru()
    {
        return $this->nameru;
    }

    /**
     * Set nameen
     *
     * @param string $nameen
     *
     * @return CciCity
     */
    public function setNameen($nameen)
    {
        $this->nameen = $nameen;
    
        return $this;
    }

    /**
     * Get nameen
     *
     * @return string
     */
    public function getNameen()
    {
        return $this->nameen;
    }

    /**
     * Set idcountry
     *
     * @param \DmnDatabase\Entity\CciCountry $idcountry
     *
     * @return CciCity
     */
    public function setIdcountry(\DmnDatabase\Entity\CciCountry $idcountry = null)
    {
        $this->idcountry = $idcountry;
    
        return $this;
    }

    /**
     * Get idcountry
     *
     * @return \DmnDatabase\Entity\CciCountry
     */
    public function getIdcountry()
    {
        return $this->idcountry;
    }

    /**
     * Set idregion
     *
     * @param \DmnDatabase\Entity\CciRegion $idregion
     *
     * @return CciCity
     */
    public function setIdregion(\DmnDatabase\Entity\CciRegion $idregion = null)
    {
        $this->idregion = $idregion;
    
        return $this;
    }

    /**
     * Get idregion
     *
     * @return \DmnDatabase\Entity\CciRegion
     */
    public function getIdregion()
    {
        return $this->idregion;
    }
}
