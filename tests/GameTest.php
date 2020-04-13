<?php

use Mini\Game;
use Mini\Player;

class GameTest extends PHPUnit_Framework_TestCase
{
    protected $game;

    public function setUp()
    {
        $this->game = new Game();
        $player1 = new Player();
        $this->game->addPlayer($player1);
    }

    public function testPlayerShouldStartOnFirstBlock()
    {
        $player = $this->game->getPlayer(1);
        $this->assertEquals(1, $player->getPosition());
    }

    public function testPlayerShouldBeInFifthBlockAfterMovingFourBlock()
    {
        $player = $this->game->getPlayer(1);
        $player->move(4);
        $this->assertEquals(5, $player->getPosition());
    }
}