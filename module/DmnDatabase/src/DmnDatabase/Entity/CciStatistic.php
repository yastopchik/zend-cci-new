<?php

namespace DmnDatabase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CciStatistic
 *
 * @ORM\Table(name="cci_statistic", indexes={@ORM\Index(name="statictic_to_user_idx", columns={"UserId"})})
 * @ORM\Entity
 */
class CciStatistic
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
     * @ORM\Column(name="NumOfVisits", type="integer", nullable=false)
     */
    private $numofvisits = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="NumOfSertif", type="integer", nullable=false)
     */
    private $numofsertif = '1';

    /**
     * @var \DmnDatabase\Entity\CciUser
     *
     * @ORM\ManyToOne(targetEntity="DmnDatabase\Entity\CciUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="UserId", referencedColumnName="Id")
     * })
     */
    private $userid;



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
     * Set numofvisits
     *
     * @param integer $numofvisits
     *
     * @return CciStatistic
     */
    public function setNumofvisits($numofvisits)
    {
        $this->numofvisits = $numofvisits;
    
        return $this;
    }

    /**
     * Get numofvisits
     *
     * @return integer
     */
    public function getNumofvisits()
    {
        return $this->numofvisits;
    }

    /**
     * Set numofsertif
     *
     * @param integer $numofsertif
     *
     * @return CciStatistic
     */
    public function setNumofsertif($numofsertif)
    {
        $this->numofsertif = $numofsertif;
    
        return $this;
    }

    /**
     * Get numofsertif
     *
     * @return integer
     */
    public function getNumofsertif()
    {
        return $this->numofsertif;
    }

    /**
     * Set userid
     *
     * @param \DmnDatabase\Entity\CciUser $userid
     *
     * @return CciStatistic
     */
    public function setUserid(\DmnDatabase\Entity\CciUser $userid = null)
    {
        $this->userid = $userid;
    
        return $this;
    }

    /**
     * Get userid
     *
     * @return \DmnDatabase\Entity\CciUser
     */
    public function getUserid()
    {
        return $this->userid;
    }
}
