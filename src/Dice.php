<?php

namespace Mini;

class Dice
{
    /** @var int */
    protected $position = 0;

    const START = 1;
    const END = 6;

    /**
     * @return void
     */
    public function roll()
    {
        $rand = mt_rand(self::START, self::END);
        $this->setPosition($rand);
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
}