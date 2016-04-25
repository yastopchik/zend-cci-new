<?php

namespace DmnDatabase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CciContent
 *
 * @ORM\Table(name="cci_content")
 * @ORM\Entity
 */
class CciContent
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
     * @ORM\Column(name="Static", type="string", length=45, nullable=true)
     */
    private $static;

    /**
     * @var string
     *
     * @ORM\Column(name="Title", type="string", length=150, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="Content", type="text", length=65535, nullable=true)
     */
    private $content;



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
     * Set static
     *
     * @param string $static
     *
     * @return CciContent
     */
    public function setStatic($static)
    {
        $this->static = $static;
    
        return $this;
    }

    /**
     * Get static
     *
     * @return string
     */
    public function getStatic()
    {
        return $this->static;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return CciContent
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return CciContent
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}
