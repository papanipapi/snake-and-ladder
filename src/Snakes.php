<?php

namespace Mini;

class Snakes extends Npc implements INpc
{
    /**
     * @param $number
     */
    public function generate($number)
    {
        for ($i=1; $i<=$number; $i++) {
            $class = new Snake();
            $this->add($class);
        }
    }
}