<?php

namespace Test\ZombieBundle\Entity;

/**
 * Class Tag
 * @package Test\ZombieBundle\Entity
 */
class Tag
{
    public $name;

    public function addTask(Task $task)
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks->add($task);
        }
    }
}