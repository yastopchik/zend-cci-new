<?php

namespace DmnDatabase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CciRegion
 *
 * @ORM\Table(name="cci_region", indexes={@ORM\Index(name="region_to_country_idx", columns={"idcountry"})})
 * @ORM\Entity
 */
class CciRegion
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
     * @var integer
     *
     * @ORM\Column(name="idcountry", type="integer", nullable=true)
     */
    private $idcountry;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idcountry
     *
     * @param integer $idcountry
     *
     * @return CciRegion
     */
    public function setIdcountry($idcountry)
    {
        $this->idcountry = $idcountry;
    
        return $this;
    }

    /**
     * Get idcountry
     *
     * @return integer
     */
    public function getIdcountry()
    {
        return $this->idcountry;
    }

    /**
     * Set nameru
     *
     * @param string $nameru
     *
     * @return CciRegion
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
     * @return CciRegion
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
}
