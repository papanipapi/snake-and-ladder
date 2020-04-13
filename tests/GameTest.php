<?php

use Mini\Game;
use Mini\Player;

class GameTest extends PHPUnit_Framework_TestCase
{
    public function testConsistOfPlayer()
    {
        $game = new Game();
        $player1 = new Player();
        $game->addPlayer($player1);
        $player = $game->getPlayer(1);
        $this->assertEquals(1, $player->getPosition());
    }
}