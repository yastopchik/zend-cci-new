<?php

namespace DmnDatabase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CciStatus
 *
 * @ORM\Table(name="cci_status")
 * @ORM\Entity
 */
class CciStatus
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
     * @ORM\Column(name="Status", type="string", length=50, nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="StatusDescription", type="string", length=255, nullable=false)
     */
    private $statusdescription;



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
     * Set status
     *
     * @param string $status
     *
     * @return CciStatus
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set statusdescription
     *
     * @param string $statusdescription
     *
     * @return CciStatus
     */
    public function setStatusdescription($statusdescription)
    {
        $this->statusdescription = $statusdescription;
    
        return $this;
    }

    /**
     * Get statusdescription
     *
     * @return string
     */
    public function getStatusdescription()
    {
        return $this->statusdescription;
    }
}
