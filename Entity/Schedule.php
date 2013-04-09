<?php

namespace Esolving\Eschool\RoomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Esolving\Eschool\RoomBundle\Entity\Schedule
 *
 * @ORM\Table(name="rooms__schedules")
 * @ORM\Entity(repositoryClass="Esolving\Eschool\RoomBundle\Repository\ScheduleRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Schedule {
    
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
     * @var room 
     * @ORM\ManyToOne(targetEntity="Room", inversedBy="schedules")
     * @Assert\NotBlank()
     */
    private $room;

    /**
     *
     * @var teacher 
     * @ORM\ManyToOne(targetEntity="Esolving\Eschool\UserBundle\Entity\Teacher", inversedBy="schedules")
     * @Assert\NotBlank()
     */
    private $teacher;
    
    /**
     *
     * @var timeStart 
     * @ORM\Column(name="timeStart", type="time")
     */
    private $timeStart;
    
    /**
     *
     * @var timeEnd
     * @ORM\Column(name="timeEnd", type="time")
     */
    private $timeEnd;

    /**
     * @var \DateTime $createdAt
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime $updatedAt
     *
     * @ORM\Column(name="updatedAt", type="datetime",nullable=true)
     */
    private $updatedAt;

    /**
     * @var \DateTime $disabledAt
     *
     * @ORM\Column(name="disabledAt", type="datetime",nullable=true)
     */
    private $disabledAt;
    
    /**
     *
     * @var type 
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;
    
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
        $this->createdAt = new \DateTime;
        $this->status = true;
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
     * Set timeStart
     *
     * @param \DateTime $timeStart
     * @return Schedule
     */
    public function setTimeStart($timeStart)
    {
        $this->timeStart = $timeStart;
    
        return $this;
    }

    /**
     * Get timeStart
     *
     * @return \DateTime 
     */
    public function getTimeStart()
    {
        return $this->timeStart;
    }

    /**
     * Set timeEnd
     *
     * @param \DateTime $timeEnd
     * @return Schedule
     */
    public function setTimeEnd($timeEnd)
    {
        $this->timeEnd = $timeEnd;
    
        return $this;
    }

    /**
     * Get timeEnd
     *
     * @return \DateTime 
     */
    public function getTimeEnd()
    {
        return $this->timeEnd;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Schedule
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
     * @return Schedule
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
     * @return Schedule
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
     * @return Schedule
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
     * Set room
     *
     * @param \Esolving\Eschool\RoomBundle\Entity\Room $room
     * @return Schedule
     */
    public function setRoom(\Esolving\Eschool\RoomBundle\Entity\Room $room = null)
    {
        $this->room = $room;
    
        return $this;
    }

    /**
     * Get room
     *
     * @return \Esolving\Eschool\RoomBundle\Entity\Room 
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Set teacher
     *
     * @param \Esolving\Eschool\UserBundle\Entity\Teacher $teacher
     * @return Schedule
     */
    public function setTeacher(\Esolving\Eschool\UserBundle\Entity\Teacher $teacher = null)
    {
        $this->teacher = $teacher;
    
        return $this;
    }

    /**
     * Get teacher
     *
     * @return \Esolving\Eschool\UserBundle\Entity\Teacher 
     */
    public function getTeacher()
    {
        return $this->teacher;
    }
}