<?php

use Mini\Dice;

class DiceTest extends PHPUnit_Framework_TestCase
{
    public function testRoll()
    {
        $dice = new Dice();
        $dice->roll();
        $position = $dice->getPosition();
        $this->assertGreaterThan(0, $position);
        $this->assertLessThan(7, $position);
    }
}