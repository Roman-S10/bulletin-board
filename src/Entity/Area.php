<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AreaRepository")
 * @ORM\Table(name="area")
 */
class Area
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
     * @ORM\OneToMany(targetEntity="App\Entity\Announcement", mappedBy="area")
     */
    private $announcements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\City", mappedBy="area")
     */
    private $cities;

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
        $this->cities        = new ArrayCollection();
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
     * @return Area
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
     * Set announcement
     *
     * @param Announcement $announcement
     * @return Area
     */
    public function setAnnouncement($announcement)
    {
        $this->announcements->add($announcement);

        return $this;
    }

    /**
     * Get cities
     *
     * @return ArrayCollection
     */
    public function getCities()
    {
        return $this->announcements;
    }

    /**
     * Set city
     *
     * @param City $city
     * @return Area
     */
    public function setCity($city)
    {
        $this->cities->add($city);

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
     * @return Area
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
     * @return Area
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
     * @return Area
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
     * @return Area
     */
    public function setDeleteTime($deleteTime)
    {
        $this->deleteTime = $deleteTime;

        return $this;
    }
}