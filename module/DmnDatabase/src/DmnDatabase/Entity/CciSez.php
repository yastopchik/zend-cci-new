<?php

namespace DmnDatabase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CciSez
 *
 * @ORM\Table(name="cci_sez")
 * @ORM\Entity
 */
class CciSez
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
     * @ORM\Column(name="prefix", type="string", length=10, nullable=false)
     */
    private $prefix = 'резидент';

    /**
     * @var string
     *
     * @ORM\Column(name="SezName", type="string", length=75, nullable=true)
     */
    private $sezname;
    /**
     * @var string
     *
     * @ORM\Column(name="SezNameEn", type="string", length=75, nullable=true)
     */
    private $seznameen;


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
     * Set prefix
     *
     * @param string $prefix
     *
     * @return CciSez
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    
        return $this;
    }

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set sezname
     *
     * @param string $sezname
     *
     * @return CciSez
     */
    public function setSezname($sezname)
    {
        $this->sezname = $sezname;
    
        return $this;
    }

    /**
     * Get sezname
     *
     * @return string
     */
    public function getSezname()
    {
        return $this->sezname;
    }
    /**
     * Set seznameen
     *
     * @param string $seznameen
     *
     * @return CciSez
     */
    public function setSeznameen($seznameen)
    {
        $this->seznameen = $seznameen;
    
        return $this;
    }
    
    /**
     * Get seznameen
     *
     * @return string
     */
    public function getSeznameen()
    {
        return $this->seznameen;
    }
}
