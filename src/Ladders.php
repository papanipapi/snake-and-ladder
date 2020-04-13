<?php

namespace Mini;

class Ladders extends Npc implements INpc
{
    /**
     * @param $number
     */
    public function generate($number)
    {
        for ($i=1; $i<=$number; $i++) {
            $class = new Ladder();
            $this->add($class);
        }
    }
}