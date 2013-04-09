<?php

namespace Esolving\Eschool\RoomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Esolving\Eschool\RoomBundle\Entity\StudentInscribe
 *
 * @ORM\Table(name="students__inscribe")
 * @ORM\Entity(repositoryClass="Esolving\Eschool\RoomBundle\Repository\StudentInscribeRepository")
 * @ORM\HasLifecycleCallbacks
 */
class StudentInscribe
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
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var \DateTime $disabledAt
     *
     * @ORM\Column(name="disabledAt", type="datetime", nullable=true)
     */
    private $disabledAt;
    
    /**
     * @var string $inscribedYearAt
     *
     * @ORM\Column(name="inscribedYearAt", type="string", length=4)
     */
    private $inscribedYearAt;
    
    /**
     * @var string $inscribedAt
     *
     * @ORM\Column(name="inscribedAt", type="date")
     */
    private $inscribedAt;
   
    /**
     *
     * @var type 
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;
    
    /**
     *
     * @var type 
     * @ORM\ManyToOne(targetEntity="Esolving\Eschool\RoomBundle\Entity\Room")
     * @Assert\NotBlank();
     */
    private $room;
    
    /**
     *
     * @var type 
     * @ORM\ManyToOne(targetEntity="Esolving\Eschool\UserBundle\Entity\Student", inversedBy="studentInscribes")
     * @Assert\NotBlank();
     */
    private $student;
    
    public function __construct() {
        $this->status = true;
        $this->createdAt = new \DateTime();
        $this->inscribedYearAt = date('Y');
        $this->inscribedAt = new \DateTime();
    }
    
    /**
     * @ORM\PreUpdate()
     */
    public function preUpdatedAt() {
        $this->updatedAt = new \DateTime();
        $this->inscribedYearAt = date('Y');
        $this->inscribedAt = new \DateTime();
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
     * @return StudentInscribe
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
     * @return StudentInscribe
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
     * @return StudentInscribe
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
     * Set inscribedYearAt
     *
     * @param string $inscribedYearAt
     * @return StudentInscribe
     */
    public function setInscribedYearAt($inscribedYearAt)
    {
        $this->inscribedYearAt = $inscribedYearAt;
    
        return $this;
    }

    /**
     * Get inscribedYearAt
     *
     * @return string 
     */
    public function getInscribedYearAt()
    {
        return $this->inscribedYearAt;
    }

    /**
     * Set inscribedAt
     *
     * @param \DateTime $inscribedAt
     * @return StudentInscribe
     */
    public function setInscribedAt($inscribedAt)
    {
        $this->inscribedAt = $inscribedAt;
    
        return $this;
    }

    /**
     * Get inscribedAt
     *
     * @return \DateTime 
     */
    public function getInscribedAt()
    {
        return $this->inscribedAt;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return StudentInscribe
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
     * @return StudentInscribe
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
     * Set student
     *
     * @param \Esolving\Eschool\UserBundle\Entity\Student $student
     * @return StudentInscribe
     */
    public function setStudent(\Esolving\Eschool\UserBundle\Entity\Student $student = null)
    {
        $this->student = $student;
    
        return $this;
    }

    /**
     * Get student
     *
     * @return \Esolving\Eschool\UserBundle\Entity\Student 
     */
    public function getStudent()
    {
        return $this->student;
    }
}