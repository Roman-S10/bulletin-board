<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="category")
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Announcement", mappedBy="category")
     */
    private $announcements;

    /**
     * @ORM\Column(name="create_time", type="datetime", nullable=false)
     */
    private $createTime;

    /**
     * @ORM\Column(name="update_time", type="datetime", nullable=true)
     */
    private $updateTime;

    /**
     * @ORM\Column(name="delete_time", type="datetime", nullable=true)
     */
    private $deleteTime;

    public function __construct()
    {
        $this->announcements = new ArrayCollection();
        $this->createTime    = new \DateTime();
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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get announcements
     *
     * @return ArrayCollection
     */
    public function getAnnouncements()
    {
        return $this->announcements;
    }

    /**
     * Set Announcement
     *
     * @param Announcement $announcement
     * @return Category
     */
    public function setAnnouncement($announcement)
    {
        $this->announcements->add($announcement);

        return $this;
    }

    /**
     * Is deleted?
     *
     * @return boolean
     */
    public function isDeleted()
    {
        return $this->deleteTime !== null;
    }

    /**
     * Set is deleted
     *
     * @param boolean $isDeleted
     *
     * @return Category
     */
    public function setIsDeleted($isDeleted)
    {
        $this->setDeleteTime($isDeleted ? new \DateTime() : null);

        return $this;
    }

    /**
     * Get create time
     *
     * @return \DateTime
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * Set create time
     *
     * @param \DateTime $createTime
     *
     * @return Category
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * Get update time
     *
     * @return \DateTime
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    /**
     * Set update time
     *
     * @param \DateTime $updateTime
     *
     * @return Category
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    /**
     * Get delete time
     *
     * @return \DateTime
     */
    public function getDeleteTime()
    {
        return $this->deleteTime;
    }

    /**
     * Set delete time
     *
     * @param \DateTime $deleteTime
     *
     * @return Category
     */
    public function setDeleteTime($deleteTime)
    {
        $this->deleteTime = $deleteTime;

        return $this;
    }

}