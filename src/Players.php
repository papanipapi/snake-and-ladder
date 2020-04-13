<?php

namespace Mini;

class Players extends Character implements \ArrayAccess,\Iterator
{
    protected $offset = 0;

    /**
     * @return Player
     */
    public function current()
    {
        return $this->offsetGet($this->offset);
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        $this->offset++;
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return $this->offset;
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        return $this->offsetExists($this->offset);
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        $this->offset = 0;
    }
}