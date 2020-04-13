<?php

namespace Mini;

/**
 * Class Npc
 * @package Mini
 */
class Npc extends Character
{
    /**
     * @param array $positions
     */
    public function setPositions($positions)
    {
        foreach ($this->getIterator() as $npc) {
            $start = array_shift($positions);
            $end = array_shift($positions);
            if ($start < $end) {
                $tmp_start = $start;
                $tmp_end = $end;
                $start = $tmp_end;
                $end = $tmp_start;
            }
            $npc->setStart($start);
            $npc->setEnd($end);
        }
    }
}