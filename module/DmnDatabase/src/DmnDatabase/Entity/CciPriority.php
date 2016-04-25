<?php

namespace DmnDatabase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CciPriority
 *
 * @ORM\Table(name="cci_priority")
 * @ORM\Entity
 */
class CciPriority
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
     * @ORM\Column(name="Priority", type="string", length=50, nullable=true)
     */
    private $priority;



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
     * Set priority
     *
     * @param string $priority
     *
     * @return CciPriority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    
        return $this;
    }

    /**
     * Get priority
     *
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }
}
