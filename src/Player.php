<?php

namespace Mini;

class Player
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var int */
    protected $position;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @param int $number
     */
    public function move($number)
    {
        $this->position += $number;
    }

    /**
     * @param int $block
     */
    public function skip($block)
    {
        $this->setPosition($block);
    }
}