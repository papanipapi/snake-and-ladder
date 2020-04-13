<?php

use Mini\Board;
use Mini\Player;
use Mini\Players;
use Mini\Snakes;
use Mini\Ladders;

class _BoardTest extends PHPUnit_Framework_TestCase
{
    protected $board;
    protected $numberOfBlock = 0;

    public function setUp()
    {
        $this->board = new Board();
    }

    public function testNumberOfBlock()
    {
        $this->board->setNumberOfBlock(50);

        $this->assertEquals(50, $this->board->getNumberOfBlock());

        $this->board->setNumberOfBlock(100);

        $this->assertEquals(100, $this->board->getNumberOfBlock());
    }

    public function testGenerateUnique()
    {
        $this->board->setNumberOfBlock(50);
        $randomBlock = $this->board->generateUnique(10);

        $this->assertEquals(10, count($randomBlock));
    }

    public function testSplitBlock()
    {
        $this->board->setNumberOfBlock(50);
        $randomBlock = $this->board->generateUnique(40);

        list($red, $blue) = $this->board->splitBlock($randomBlock, 2);

        $this->assertEquals(20, count($red));
        $this->assertEquals(20, count($blue));
    }

    public function testIsComplete()
    {
        $numberOfBlock = 100;
        $this->board->setNumberOfBlock($numberOfBlock);

        $this->board->setPlayers(null);

        $isComplete = $this->board->isComplete();
        $this->assertFalse($isComplete);

        $player = new Player();

        $players = new Players();
        $players->add($player);

        $this->board->setPlayers($players);

        $isComplete = $this->board->isComplete();
        $this->assertFalse($isComplete);

        $currentPlayer = $this->board->getPlayers()->current();
        $currentPlayer->move($numberOfBlock);

        $isComplete = $this->board->isComplete();
        $this->assertTrue($isComplete);
    }

    public function testIsLandedOnSnakesHead()
    {
        $numberOfBlock = 100;
        $numberOfUniqueBlock = 16;
        $numberOfNpc = ($numberOfUniqueBlock / 4);

        $this->board->setNumberOfBlock($numberOfBlock);
        $this->assertFalse($this->board->isLandedOnSnakesHead());

        $player = new Player();

        $players = new Players();
        $players->add($player);

        $uniqueBlock = $this->board->generateUnique($numberOfUniqueBlock);
        list($snakeBlock, $ladderBlock) = $this->board->splitBlock($uniqueBlock);

        $snakeBlock[0] = 99;

        $snakes = new Snakes();
        $snakes->generate($numberOfNpc);
        $snakes->setPositions($snakeBlock);

        $this->board->setPlayers($players);
        $this->board->setSnakes($snakes);

        $currentPlayer = $this->board->getCurrentPlayer();
        $currentPlayer->move($snakeBlock[0]);

        $this->assertTrue($this->board->isLandedOnSnakesHead());
    }

    public function testIsLandedOnLaddersEnd()
    {
        $numberOfBlock = 100;
        $numberOfUniqueBlock = 16;
        $numberOfNpc = ($numberOfUniqueBlock / 4);

        $this->board->setNumberOfBlock($numberOfBlock);
        $this->assertFalse($this->board->isLandedOnLaddersEnd());

        $player = new Player();

        $players = new Players();
        $players->add($player);

        $uniqueBlock = $this->board->generateUnique($numberOfUniqueBlock);
        list($snakeBlock, $ladderBlock) = $this->board->splitBlock($uniqueBlock);

        $ladderBlock[1] = 2;

        $ladders = new Ladders();
        $ladders->generate($numberOfNpc);
        $ladders->setPositions($ladderBlock);

        $this->board->setPlayers($players);
        $this->board->setLadders($ladders);

        $currentPlayer = $this->board->getCurrentPlayer();
        $currentPlayer->move($ladderBlock[1]);

        $this->assertTrue($this->board->isLandedOnLaddersEnd());
    }

    public function testIsReachNumberOfBlock()
    {
        $numberOfBlock = 100;

        $this->board->setNumberOfBlock($numberOfBlock);
        $this->assertFalse($this->board->isReachNumberOfBlock());

        $player = new Player();

        $players = new Players();
        $players->add($player);

        $this->board->setPlayers($players);

        $player->move(101);

        $this->assertTrue($this->board->isReachNumberOfBlock());
    }

    public function testExceedBlock()
    {
        $numberOfBlock = 100;

        $this->board->setNumberOfBlock($numberOfBlock);

        $player = new Player();

        $players = new Players();
        $players->add($player);

        $this->board->setPlayers($players);

        $player->move(106);

        $player->move($this->board->getExceedBlock());

        $this->assertEquals(94, $this->board->getCurrentPlayerPosition());
    }

    protected function getMockPlayers()
    {
        $players = $this->getMockBuilder('\Mini\Players')
            ->getMock();

        $player = $this->getMockPlayer();
        $this->setProtectedProperty($players, 'container', array($player));

        $players->expects($this->any())
            ->method('current')
            ->will($this->returnValue($player));

        return $players;
    }

    public function setProtectedProperty($object, $property, $value)
    {
        $reflection = new ReflectionClass($object);
        $reflection_property = $reflection->getProperty($property);
        $reflection_property->setAccessible(true);
        $reflection_property->setValue($object, $value);
    }

    public function getMockPlayer()
    {
        $player = $this->getMockBuilder('\Mini\Player')
            ->getMock();

        $player->expects($this->any())
            ->method('move')
            ->will($this->returnValue($this->numberOfBlock = $this->board->getNumberOfBlock()));

        $player->expects($this->any())
            ->method('getPosition')
            ->will($this->returnValue($this->numberOfBlock));

        return $player;
    }

    public function getMockSnakes()
    {
        $snakes = $this->getMockBuilder('Snakes')
                ->getMock();

        $snakes->expects($this->any())
            ->method('update')
            ->will($this->returnValue('foo'));

        return $snakes;
    }

    public function getMockSnake()
    {
        $snakes = $this->getMockBuilder('Snake')
            ->getMock();

        $snakes->expects($this->any())
            ->method('update')
            ->will($this->returnValue('foo'));

        return $snakes;
    }
}