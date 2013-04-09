<?php

namespace Esolving\Eschool\RoomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Esolving\Eschool\RoomBundle\Entity\Course
 *
 * @ORM\Table(name="courses")
 * @ORM\Entity(repositoryClass="Esolving\Eschool\RoomBundle\Repository\CourseRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Course
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

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
     * @ORM\ManyToOne(targetEntity="Esolving\Eschool\CoreBundle\Entity\Type")
     */
    private $courseType;

    public function __construct() {
        $this->createdAt = new \DateTime();
    }
    
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
     * @return Course
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
     * @return Course
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
     * @return Course
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
     * Set courseType
     *
     * @param \Esolving\Eschool\CoreBundle\Entity\Type $courseType
     * @return Course
     */
    public function setCourseType(\Esolving\Eschool\CoreBundle\Entity\Type $courseType = null)
    {
        $this->courseType = $courseType;
    
        return $this;
    }

    /**
     * Get courseType
     *
     * @return \Esolving\Eschool\CoreBundle\Entity\Type 
     */
    public function getCourseType()
    {
        return $this->courseType;
    }
}