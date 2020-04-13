<?php

use Mini\Players;

class PlayersTest extends PHPUnit_Framework_TestCase
{
    public function testAddPlayer()
    {
        $players = new Players();
        $players->add($this->getMockPlayer());

        $this->assertEquals(1, $players->count());

        $players->add($this->getMockPlayer());
        $players->add($this->getMockPlayer());

        $this->assertEquals(3, $players->count());
    }

    public function testAddMultiplePlayers()
    {
        $player1 = $this->getMockPlayer();
        $player2 = $this->getMockPlayer();
        $players = new Players();
        $players->addMultiple(array($player1, $player2));

        $this->assertEquals(2, $players->count());

        $players->addMultiple(array($player1, $player2));

        $this->assertEquals(4, $players->count());
    }

    public function testRemovePlayer()
    {
        $player1 = $this->getMockPlayer();
        $player2 = $this->getMockPlayer();
        $players = new Players();
        $players->addMultiple(array($player1, $player2));
        $players->remove(1);

        $this->assertEquals(1, $players->count());

        $players->addMultiple(array($player1, $player2));

        $players->remove(0);
        $players->remove(2);

        $this->assertEquals(1, $players->count());
    }

    public function testClearPlayer()
    {
        $players = new Players();
        $players->add($this->getMockPlayer());
        $players->add($this->getMockPlayer());
        $players->add($this->getMockPlayer());
        $players->clear();

        $this->assertEquals(0, $players->count());
    }

    public function testReinitializePlayer()
    {
        $player = $this->getMockPlayer();
        $players = new Players($player);
        $players->clear();

        $this->assertEquals(0, $players->count());

        $players->add($player);

        $this->assertEquals(1, $players->count());
    }

    private function getMockPlayer()
    {
        return $this->getMockBuilder('Mini\Player')
            ->getMock();
    }
}