<?php

declare(strict_types = 1);

namespace BitWasp\Bitcoin\Transaction\Mutator;

abstract class AbstractCollectionMutator implements \IteratorAggregate, \ArrayAccess, \Countable
{
    /**
     * @var \SplFixedArray
     */
    protected $set;

    public function getIterator()
    {
        return $this->set;
    }

    public function all(): array
    {
        return $this->set->toArray();
    }

    public function isNull(): bool
    {
        return count($this->set) === 0;
    }

    public function count(): int
    {
        return $this->set->count();
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->set->offsetExists($offset);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset): void
    {
        if (! $this->offsetExists($offset)) {
            throw new \InvalidArgumentException('Offset does not exist');
        }

        $this->set->offsetUnset($offset);
    }

    /**
     * @param int $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        if (! $this->set->offsetExists($offset)) {
            throw new \OutOfRangeException('Nothing found at this offset');
        }

        return $this->set->offsetGet($offset);
    }

    /**
     * @param int   $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value): void
    {
        $this->set->offsetSet($offset, $value);
    }
}
