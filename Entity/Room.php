<?php

namespace Esolving\Eschool\RoomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Esolving\Eschool\RoomBundle\Validator\Constraints as EsolvingEschoolRoomBundle;

/**
 * Esolving\Eschool\RoomBundle\Entity\Room
 *
 * @ORM\Table(name="rooms",uniqueConstraints={@ORM\UniqueConstraint(name="search_idx", columns={"roomType_id", "headquarterType_id", "sectionType_id"})})
 * @ORM\Entity(repositoryClass="Esolving\Eschool\RoomBundle\Repository\RoomRepository")
 * @ORM\HasLifecycleCallbacks
 * @EsolvingEschoolRoomBundle\RoomUniqueConstraints
 */
class Room {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @var type 
     * @ORM\ManyToOne(targetEntity="Esolving\Eschool\CoreBundle\Entity\Type")
     */
    private $roomType;

    /**
     *
     * @var type 
     * @ORM\ManyToOne(targetEntity="Esolving\Eschool\CoreBundle\Entity\Type")
     */
    private $headquarterType;

    /**
     *
     * @var type 
     * @ORM\ManyToOne(targetEntity="Esolving\Eschool\CoreBundle\Entity\Type")
     */
    private $sectionType;

    /**
     *
     * @var date
     * @ORM\Column(name="createdAt", type="datetime")
     */
    protected $createdAt;

    /**
     *
     * @var date
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     *
     * @var date
     * @ORM\Column(name="disabledAt", type="datetime", nullable=true)
     */
    protected $disabledAt;

    /**
     * @var boolean $status
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;

    /**
     *
     * @var type 
     * @ORM\OneToMany(targetEntity="Schedule", mappedBy="room")
     */
    private $schedules;

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdatedAt() {
        $this->updatedAt = new \DateTime();
        if (!$this->getStatus()) {
            $this->disabledAt = new \DateTime();
        } else {
            $this->disabledAt = null;
        }
    }

    public function __toString() {
        return '';
    }
    
    public function __construct() {
        $this->createdAt = new \DateTime();
        $this->status = true;
        $this->schedules = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Room
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Room
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set disabledAt
     *
     * @param \DateTime $disabledAt
     * @return Room
     */
    public function setDisabledAt($disabledAt)
    {
        $this->disabledAt = $disabledAt;
    
        return $this;
    }

    /**
     * Get disabledAt
     *
     * @return \DateTime 
     */
    public function getDisabledAt()
    {
        return $this->disabledAt;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Room
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set roomType
     *
     * @param \Esolving\Eschool\CoreBundle\Entity\Type $roomType
     * @return Room
     */
    public function setRoomType(\Esolving\Eschool\CoreBundle\Entity\Type $roomType = null)
    {
        $this->roomType = $roomType;
    
        return $this;
    }

    /**
     * Get roomType
     *
     * @return \Esolving\Eschool\CoreBundle\Entity\Type 
     */
    public function getRoomType()
    {
        return $this->roomType;
    }

    /**
     * Set headquarterType
     *
     * @param \Esolving\Eschool\CoreBundle\Entity\Type $headquarterType
     * @return Room
     */
    public function setHeadquarterType(\Esolving\Eschool\CoreBundle\Entity\Type $headquarterType = null)
    {
        $this->headquarterType = $headquarterType;
    
        return $this;
    }

    /**
     * Get headquarterType
     *
     * @return \Esolving\Eschool\CoreBundle\Entity\Type 
     */
    public function getHeadquarterType()
    {
        return $this->headquarterType;
    }

    /**
     * Set sectionType
     *
     * @param \Esolving\Eschool\CoreBundle\Entity\Type $sectionType
     * @return Room
     */
    public function setSectionType(\Esolving\Eschool\CoreBundle\Entity\Type $sectionType = null)
    {
        $this->sectionType = $sectionType;
    
        return $this;
    }

    /**
     * Get sectionType
     *
     * @return \Esolving\Eschool\CoreBundle\Entity\Type 
     */
    public function getSectionType()
    {
        return $this->sectionType;
    }

    /**
     * Add schedules
     *
     * @param \Esolving\Eschool\RoomBundle\Entity\Schedule $schedules
     * @return Room
     */
    public function addSchedule(\Esolving\Eschool\RoomBundle\Entity\Schedule $schedules)
    {
        $this->schedules[] = $schedules;
    
        return $this;
    }

    /**
     * Remove schedules
     *
     * @param \Esolving\Eschool\RoomBundle\Entity\Schedule $schedules
     */
    public function removeSchedule(\Esolving\Eschool\RoomBundle\Entity\Schedule $schedules)
    {
        $this->schedules->removeElement($schedules);
    }

    /**
     * Get schedules
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSchedules()
    {
        return $this->schedules;
    }
}