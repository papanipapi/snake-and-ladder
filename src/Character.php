<?php

namespace Mini;

class Character
{
    /** @var mixed */
    protected $container;

    /**
     * @return mixed
     */
    public function getIterator()
    {
        return $this->container;
    }

    /**
     * @param mixed $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset)) {
            return $this->container[$offset];
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        if (!is_null($offset)) {
            $this->container[$offset] = $value;
            return;
        }
        $this->container[] = $value;
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        if (!$this->offsetExists($offset)) {
            return;
        }
        unset($this->container[$offset]);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->container);
    }

    /**
     * @return void
     */
    public function clear()
    {
        $this->container = null;
    }

    /**
     * @param $value
     * @return void
     */
    public function add($value)
    {
        $this->offsetSet(null, $value);
    }

    /**
     * @param int $position
     */
    public function remove($position)
    {
        $this->offsetUnset($position);
    }

    /**
     * @param Character[] $characters
     */
    public function addMultiple($characters)
    {
        /** @var Character $character */
        foreach ($characters as $character) {
            $this->add($character);
        }
    }
}