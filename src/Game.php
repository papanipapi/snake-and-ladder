<?php

namespace Mini;

class Game
{
    protected $players = array();

    public function addPlayer($player)
    {
        $this->players[] = $player;
    }

    public function getPlayer($position)
    {
        $position--;
        return isset($this->players[$position]) ? $this->players[$position] : null;
    }
}