<?php

use Mini\Game;
use Mini\Player;

class GameTest extends PHPUnit_Framework_TestCase
{
    public function testPlayerShouldStartOnFirstBlock()
    {
        $game = new Game();
        $player1 = new Player();
        $game->addPlayer($player1);
        $player = $game->getPlayer(1);
        $this->assertEquals(1, $player->getPosition());
    }

    public function testPlayerShouldBeInFifthBlockAfterMovingFourBlock()
    {
        $game = new Game();
        $player1 = new Player();
        $game->addPlayer($player1);
        $player = $game->getPlayer(1);
        $player->move(4);
        $this->assertEquals(5, $player->getPosition());
    }
}