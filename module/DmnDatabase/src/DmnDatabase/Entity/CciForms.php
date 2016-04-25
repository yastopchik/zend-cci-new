<?php

namespace DmnDatabase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CciForms
 *
 * @ORM\Table(name="cci_forms")
 * @ORM\Entity
 */
class CciForms
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
     * @ORM\Column(name="Forms", type="string", length=45, nullable=true)
     */
    private $forms;



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
     * Set forms
     *
     * @param string $forms
     *
     * @return CciForms
     */
    public function setForms($forms)
    {
        $this->forms = $forms;
    
        return $this;
    }

    /**
     * Get forms
     *
     * @return string
     */
    public function getForms()
    {
        return $this->forms;
    }
}
