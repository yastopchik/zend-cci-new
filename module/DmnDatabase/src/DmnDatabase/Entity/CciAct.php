<?php

namespace DmnDatabase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CciAct
 *
 * @ORM\Table(name="cci_act", indexes={@ORM\Index(name="acts_to_actnumber_idx", columns={"ActId"})})
 * @ORM\Entity
 */
class CciAct
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
     * @ORM\Column(name="HsCode", type="string", length=255, nullable=false)
     */
    private $hscode;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="CriOrigin", type="string", length=255, nullable=true)
     */
    private $criorigin;

    /**
     * @var \DmnDatabase\Entity\CciActNumber
     *
     * @ORM\ManyToOne(targetEntity="DmnDatabase\Entity\CciActNumber")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ActId", referencedColumnName="Id")
     * })
     */
    private $actid;



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
     * Set hscode
     *
     * @param string $hscode
     *
     * @return CciAct
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
     * Set description
     *
     * @param string $description
     *
     * @return CciAct
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
     * Set criorigin
     *
     * @param string $criorigin
     *
     * @return CciAct
     */
    public function setCriorigin($criorigin)
    {
        $this->criorigin = $criorigin;

        return $this;
    }

    /**
     * Get criorigin
     *
     * @return string
     */
    public function getCriorigin()
    {
        return $this->criorigin;
    }

    /**
     * Set actid
     *
     * @param \DmnDatabase\Entity\CciActNumber $actid
     *
     * @return CciAct
     */
    public function setActid(\DmnDatabase\Entity\CciActNumber $actid = null)
    {
        $this->actid = $actid;

        return $this;
    }

    /**
     * Get actid
     *
     * @return \DmnDatabase\Entity\CciActNumber
     */
    public function getActid()
    {
        return $this->actid;
    }
}
