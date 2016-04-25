<?php

namespace DmnDatabase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CciCountry
 *
 * @ORM\Table(name="cci_country")
 * @ORM\Entity
 */
class CciCountry
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
     * @ORM\Column(name="fullnameru", type="string", length=255, nullable=true)
     */
    private $fullnameru;

    /**
     * @var string
     *
     * @ORM\Column(name="dative", type="string", length=150, nullable=true)
     */
    private $dative;

    /**
     * @var string
     *
     * @ORM\Column(name="nameen", type="string", length=150, nullable=true)
     */
    private $nameen;

    /**
     * @var string
     *
     * @ORM\Column(name="iso", type="string", length=2, nullable=true)
     */
    private $iso;

    /**
     * @var integer
     *
     * @ORM\Column(name="order", type="integer", nullable=true)
     */
    private $order;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hide", type="boolean", nullable=true)
     */
    private $hide = '0';



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
     * @return CciCountry
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
     * Set fullnameru
     *
     * @param string $fullnameru
     *
     * @return CciCountry
     */
    public function setFullnameru($fullnameru)
    {
        $this->fullnameru = $fullnameru;
    
        return $this;
    }

    /**
     * Get fullnameru
     *
     * @return string
     */
    public function getFullnameru()
    {
        return $this->fullnameru;
    }

    /**
     * Set dative
     *
     * @param string $dative
     *
     * @return CciCountry
     */
    public function setDative($dative)
    {
        $this->dative = $dative;
    
        return $this;
    }

    /**
     * Get dative
     *
     * @return string
     */
    public function getDative()
    {
        return $this->dative;
    }

    /**
     * Set nameen
     *
     * @param string $nameen
     *
     * @return CciCountry
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
     * Set iso
     *
     * @param string $iso
     *
     * @return CciCountry
     */
    public function setIso($iso)
    {
        $this->iso = $iso;
    
        return $this;
    }

    /**
     * Get iso
     *
     * @return string
     */
    public function getIso()
    {
        return $this->iso;
    }

    /**
     * Set order
     *
     * @param integer $order
     *
     * @return CciCountry
     */
    public function setOrder($order)
    {
        $this->order = $order;
    
        return $this;
    }

    /**
     * Get order
     *
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set hide
     *
     * @param boolean $hide
     *
     * @return CciCountry
     */
    public function setHide($hide)
    {
        $this->hide = $hide;
    
        return $this;
    }

    /**
     * Get hide
     *
     * @return boolean
     */
    public function getHide()
    {
        return $this->hide;
    }
}
