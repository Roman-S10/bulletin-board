<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="announcement")
 */
class Announcement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Area", inversedBy="announcements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $area;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\City", inversedBy="announcements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="announcements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

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
        $this->createTime = new \DateTime();
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
     * Get Area
     *
     * @return Area
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set area
     *
     * @param Area $area
     * @return Announcement
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get city
     *
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set city
     *
     * @param City $city
     * @return Announcement
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set category
     *
     * @param Category $category
     * @return Announcement
     */
    public function setCategory($category)
    {
        $this->category = $category;

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
     * Set title
     *
     * @param string $title
     * @return Announcement
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Announcement
     */
    public function setDescription($description)
    {
        $this->description = $description;

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
     * @return Announcement
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
     * @return Announcement
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
     * @return Announcement
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
     * @return Announcement
     */
    public function setDeleteTime($deleteTime)
    {
        $this->deleteTime = $deleteTime;

        return $this;
    }

}