<?php

namespace Test\ZombieBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

class Task
{
    protected $description;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", cascade={"persist"})
     */
    protected $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags(ArrayCollection $tags)
    {
        foreach ($tags as $tag) {
            $tag->addTask($this);
        }

        $this->tags = $tags;
    }
}