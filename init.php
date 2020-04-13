<?php

require "vendor/autoload.php";

use Mini\Players;
use Mini\Player;
use Mini\Board;
use Mini\Dice;
use Mini\Snakes;
use Mini\Ladders;

$numberOfBlock = 100;
$numberOfUniqueBlock = 16;
$numberOfPlayer = 3;
$numberOfNpc = ($numberOfUniqueBlock / 4);

$board = new Board();
$board->setNumberOfBlock($numberOfBlock);
$uniqueBlock = $board->generateUnique($numberOfUniqueBlock);
list($snakeBlocks, $ladderBlocks) = $board->splitBlock($uniqueBlock);

$snakes = new Snakes();
$snakes->generate($numberOfNpc);
$snakes->setPositions($snakeBlocks);

$ladders = new Ladders();
$ladders->generate($numberOfNpc);
$ladders->setPositions($ladderBlocks);

$players = new Players();
for ($i=1; $i<=$numberOfPlayer; $i++) {
    $player = new Player();
    $player->setId($i);
    $players->add($player);
}

$board->setSnakes($snakes);
$board->setLadders($ladders);
$board->setPlayers($players);

$x = 0;
$players = $board->getPlayers();
while(true) {
    $players->rewind();
    for ($i=1; $i<=$numberOfPlayer; $i++) {
        $player = $players->current();

        $dice = new Dice();
        $dice->roll();
        $dicePosition = $dice->getPosition();

        $player->move($dicePosition);

        if ($board->isComplete()) {
            debug('Player %s is the winner | Roll: %d !', array($player->getId(), $dicePosition));
            return;
        } elseif ($board->isReachNumberOfBlock()) {
            $exceedBlock = $board->getExceedBlock();
            $player->move($exceedBlock);
        } elseif ($board->isLandedOnSnakesHead()) {
            $snake = $board->getLandedSnake();
            $snakeDown = $snake->getEnd();
            debug('Player %s is currently in %d going down to %d', array($player->getId(), $player->getPosition(), $snakeDown));
            $player->skip($snakeDown);
        } elseif ($board->isLandedOnLaddersEnd()) {
            $ladder = $board->getLandedLadder();
            $ladderUp = $ladder->getStart();
            debug('Player %s is currently in %d ! going up to %d', array($player->getId(), $player->getPosition(), $ladderUp));
            $player->skip($ladderUp);
        }

        $playerPosition = $player->getPosition();

        debug("Player: %d || Roll: %d || Position: %d", array($player->getId(), $dicePosition, $playerPosition));

        $players->next();
    }
}

// https://www.php.net/manual/en/function.printf.php#51763
function debug($format, $args = array()) {
    $format .= " %s";
    $args[] = "<br />";
    return call_user_func_array('printf', array_merge((array)$format, $args));
}