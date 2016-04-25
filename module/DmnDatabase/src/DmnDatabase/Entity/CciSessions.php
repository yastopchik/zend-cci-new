<?php

namespace DmnDatabase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CciSessions
 *
 * @ORM\Table(name="cci_sessions")
 * @ORM\Entity
 */
class CciSessions
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=32, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id = '';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="modified", type="integer", nullable=true)
     */
    private $modified;

    /**
     * @var integer
     *
     * @ORM\Column(name="lifetime", type="integer", nullable=true)
     */
    private $lifetime;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="text", length=65535, nullable=true)
     */
    private $data;



    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CciSessions
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set modified
     *
     * @param integer $modified
     *
     * @return CciSessions
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
    
        return $this;
    }

    /**
     * Get modified
     *
     * @return integer
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Set lifetime
     *
     * @param integer $lifetime
     *
     * @return CciSessions
     */
    public function setLifetime($lifetime)
    {
        $this->lifetime = $lifetime;
    
        return $this;
    }

    /**
     * Get lifetime
     *
     * @return integer
     */
    public function getLifetime()
    {
        return $this->lifetime;
    }

    /**
     * Set data
     *
     * @param string $data
     *
     * @return CciSessions
     */
    public function setData($data)
    {
        $this->data = $data;
    
        return $this;
    }

    /**
     * Get data
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }
}
