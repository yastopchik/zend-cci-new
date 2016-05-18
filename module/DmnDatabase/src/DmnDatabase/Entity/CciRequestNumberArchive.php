<?php

namespace DmnDatabase\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CciRequestNumberArchive
 *
 * @ORM\Table(name="cci_request_number_archive", indexes={@ORM\Index(name="sertificatenum_to_user_idx", columns={"UserId"}), @ORM\Index(name="sertificatenum_to_executor_idx", columns={"ExecutorId"}), @ORM\Index(name="sertificatenum_to_status_idx", columns={"StatusId"}), @ORM\Index(name="sertificatenum_to_priority_idx", columns={"PriorityId"}), @ORM\Index(name="sertificatenum_to_forms_idx", columns={"FormsId"})})
 * @ORM\Entity
 */
class CciRequestNumberArchive
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
     * @ORM\Column(name="WorkOrder", type="string", length=50, nullable=true)
     */
    private $workorder;

    /**
     * @var string
     *
     * @ORM\Column(name="NumBlank", type="string", length=45, nullable=true)
     */
    private $numblank;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateOrder", type="date", nullable=false)
     */
    private $dateorder;

    /**
     * @var string
     *
     * @ORM\Column(name="File", type="string", length=100, nullable=true)
     */
    private $file;

    /**
     * @var integer
     *
     * @ORM\Column(name="DestinationIso", type="integer", nullable=true)
     */
    private $destinationiso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateAcceped", type="datetime", nullable=false)
     */
    private $dateacceped;

    /**
     * @var \DmnDatabase\Entity\CciStatus
     *
     * @ORM\ManyToOne(targetEntity="DmnDatabase\Entity\CciStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="StatusId", referencedColumnName="id")
     * })
     */
    private $statusid;

    /**
     * @var \DmnDatabase\Entity\CciForms
     *
     * @ORM\ManyToOne(targetEntity="DmnDatabase\Entity\CciForms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FormsId", referencedColumnName="id")
     * })
     */
    private $formsid;

    /**
     * @var \DmnDatabase\Entity\CciUser
     *
     * @ORM\ManyToOne(targetEntity="DmnDatabase\Entity\CciUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ExecutorId", referencedColumnName="Id")
     * })
     */
    private $executorid;

    /**
     * @var \DmnDatabase\Entity\CciPriority
     *
     * @ORM\ManyToOne(targetEntity="DmnDatabase\Entity\CciPriority")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="PriorityId", referencedColumnName="id")
     * })
     */
    private $priorityid;

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
     * @var integer
     *
     * @ORM\Column(name="NumDopList", type="integer", nullable=true)
     */
    private $numdoplist;


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
     * Set workorder
     *
     * @param string $workorder
     *
     * @return CciRequestNumberArchive
     */
    public function setWorkorder($workorder)
    {
        $this->workorder = $workorder;
    
        return $this;
    }

    /**
     * Get workorder
     *
     * @return string
     */
    public function getWorkorder()
    {
        return $this->workorder;
    }

    /**
     * Set numblank
     *
     * @param string $numblank
     *
     * @return CciRequestNumberArchive
     */
    public function setNumblank($numblank)
    {
        $this->numblank = $numblank;
    
        return $this;
    }

    /**
     * Get numblank
     *
     * @return string
     */
    public function getNumblank()
    {
        return $this->numblank;
    }

    /**
     * Set dateorder
     *
     * @param \DateTime $dateorder
     *
     * @return CciRequestNumberArchive
     */
    public function setDateorder($dateorder)
    {
        $this->dateorder = $dateorder;
    
        return $this;
    }

    /**
     * Get dateorder
     *
     * @return \DateTime
     */
    public function getDateorder()
    {
        return $this->dateorder;
    }

    /**
     * Set file
     *
     * @param string $file
     *
     * @return CciRequestNumberArchive
     */
    public function setFile($file)
    {
        $this->file = $file;
    
        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set destinationiso
     *
     * @param integer $destinationiso
     *
     * @return CciRequestNumberArchive
     */
    public function setDestinationiso($destinationiso)
    {
        $this->destinationiso = $destinationiso;
    
        return $this;
    }

    /**
     * Get numdoplist
     *
     * @return integer
     */
    public function getNumDopList()
    {
        return $this->numdoplist;
    }
    /**
     * Set numdoplist
     *
     * @param integer $numdoplist
     *
     * @return CciRequestNumberArchive
     */
    public function setNumDopList($numdoplist)
    {
        $this->numdoplist = $numdoplist;
    
        return $this;
    }
    
    /**
     * Get destinationiso
     *
     * @return integer
     */
    public function getDestinationiso()
    {
        return $this->destinationiso;
    }
    /**
     * Set dateacceped
     *
     * @param \DateTime $dateacceped
     *
     * @return CciRequestNumberArchive
     */
    public function setDateacceped($dateacceped)
    {
        $this->dateacceped = $dateacceped;
    
        return $this;
    }

    /**
     * Get dateacceped
     *
     * @return \DateTime
     */
    public function getDateacceped()
    {
        return $this->dateacceped;
    }

    /**
     * Set statusid
     *
     * @param \DmnDatabase\Entity\CciStatus $statusid
     *
     * @return CciRequestNumberArchive
     */
    public function setStatusid(\DmnDatabase\Entity\CciStatus $statusid = null)
    {
        $this->statusid = $statusid;
    
        return $this;
    }

    /**
     * Get statusid
     *
     * @return \DmnDatabase\Entity\CciStatus
     */
    public function getStatusid()
    {
        return $this->statusid;
    }

    /**
     * Set formsid
     *
     * @param \DmnDatabase\Entity\CciForms $formsid
     *
     * @return CciRequestNumberArchive
     */
    public function setFormsid(\DmnDatabase\Entity\CciForms $formsid = null)
    {
        $this->formsid = $formsid;
    
        return $this;
    }

    /**
     * Get formsid
     *
     * @return \DmnDatabase\Entity\CciForms
     */
    public function getFormsid()
    {
        return $this->formsid;
    }

    /**
     * Set executorid
     *
     * @param \DmnDatabase\Entity\CciUser $executorid
     *
     * @return CciRequestNumberArchive
     */
    public function setExecutorid(\DmnDatabase\Entity\CciUser $executorid = null)
    {
        $this->executorid = $executorid;
    
        return $this;
    }

    /**
     * Get executorid
     *
     * @return \DmnDatabase\Entity\CciUser
     */
    public function getExecutorid()
    {
        return $this->executorid;
    }

    /**
     * Set priorityid
     *
     * @param \DmnDatabase\Entity\CciPriority $priorityid
     *
     * @return CciRequestNumberArchiveArchive
     */
    public function setPriorityid(\DmnDatabase\Entity\CciPriority $priorityid = null)
    {
        $this->priorityid = $priorityid;
    
        return $this;
    }

    /**
     * Get priorityid
     *
     * @return \DmnDatabase\Entity\CciPriority
     */
    public function getPriorityid()
    {
        return $this->priorityid;
    }

    /**
     * Set userid
     *
     * @param \DmnDatabase\Entity\CciUser $userid
     *
     * @return CciRequestNumberArchive
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
