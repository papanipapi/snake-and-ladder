<?php

namespace Mini;

class Board
{
    /** @var int */
    protected $numberOfBlock;

    /** @var Players */
    protected $players;

    /** @var Snakes */
    protected $snakes;

    /** @var Ladders */
    protected $ladders;

    /** @var int */
    protected $row;

    /**
     * @return int
     */
    public function getNumberOfBlock()
    {
        return $this->numberOfBlock;
    }

    /**
     * @param int $numberOfBlock
     */
    public function setNumberOfBlock($numberOfBlock)
    {
        $this->numberOfBlock = $numberOfBlock;
    }

    /**
     * @return mixed
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * @param mixed $row
     */
    public function setRow($row)
    {
        $this->row = $row;
    }

    /**
     * @return
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @param $players
     */
    public function setPlayers($players)
    {
        $this->players = $players;
    }

    /**
     * @return Snakes
     */
    public function getSnakes()
    {
        return $this->snakes;
    }

    /**
     * @param mixed $snakes
     */
    public function setSnakes($snakes)
    {
        $this->snakes = $snakes;
    }

    /**
     * @return Ladders
     */
    public function getLadders()
    {
        return $this->ladders;
    }

    /**
     * @param mixed $ladders
     */
    public function setLadders($ladders)
    {
        $this->ladders = $ladders;
    }

    /**
     * @return int
     */
    public function getRandomBlock()
    {
        return mt_rand(1, $this->getNumberOfBlock() - 1);
    }

    /**
     * @param int $number
     * @return array
     */
    public function generateUnique($number)
    {
        $numbers = array();
        for($i=1; $i<=$number; $i++) {
            $block = $this->getRandomBlock();
            if (!in_array($block, $numbers)) {
                array_push($numbers, $block);
            } else {
                $i--;
            }
        }
        return $numbers;
    }

    /**
     * @param array $blocks
     * @param int $number
     * @return array
     */
    public function splitBlock($blocks, $number = 2)
    {
        return array_chunk($blocks, (count($blocks) / $number));
    }

    /**
     * @return bool
     */
    public function isComplete()
    {
        return $this->getCurrentPlayerPosition() === $this->getNumberOfBlock();
    }

    /**
     * @return bool|Player
     */
    public function getCurrentPlayer()
    {
        if (!$this->getPlayers()) {
            return false;
        }

        return $this->getPlayers()->current();
    }

    public function getCurrentPlayerPosition()
    {
        if ($currentPlayer = $this->getCurrentPlayer()) {
            return $currentPlayer->getPosition();
        }

        return 0;
    }

    /**
     * @return bool
     */
    public function isReachNumberOfBlock()
    {
        return $this->getCurrentPlayerPosition() > $this->getNumberOfBlock();
    }

    /**
     * @return int
     */
    public function getExceedBlock()
    {
        return (($this->getNumberOfBlock() - $this->getCurrentPlayerPosition()) + $this->getNumberOfBlock()) - $this->getCurrentPlayerPosition();
    }

    /**
     * @return bool|Snake
     */
    public function getLandedSnake()
    {
        if (!$snakes = $this->getSnakes()) {
            return false;
        }

        if (!$currentPlayer = $this->getCurrentPlayer()) {
            return false;
        }

        /** @var Snake $snake */
        foreach ($snakes->getIterator() as $snake) {
            if ($snake->getStart() === $currentPlayer->getPosition()) {
                return $snake;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isLandedOnSnakesHead()
    {
        return $this->getLandedSnake() ? true : false;
    }

    /**
     * @return bool|Ladder
     */
    public function getLandedLadder()
    {
        if (!$ladders = $this->getLadders()) {
            return false;
        }

        if (!$currentPlayer = $this->getCurrentPlayer()) {
            return false;
        }

        /** @var Ladder $ladder */
        foreach ($ladders->getIterator() as $ladder) {
            if ($ladder->getEnd() === $currentPlayer->getPosition()) {
                return $ladder;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isLandedOnLaddersEnd()
    {
        return $this->getLandedLadder() ? true : false;
    }
}