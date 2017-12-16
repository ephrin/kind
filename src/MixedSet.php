<?php

namespace Ephrin\Kind;

class MixedSet implements Set, \IteratorAggregate, \Countable
{
    /**
     * @var node|null
     */
    private $head;

    /**
     * @var int
     */
    private $count = 0;

    public function __construct(...$items)
    {
        $this->head = $this->build(...$items);
    }

    /**
     * @param array ...$items
     * @return node|null
     */
    private function build(...$items)
    {
        if (\func_num_args() === 0) {
            return null;
        }
        $this->count++;
        $node = new node();
        $node->value = array_shift($items);
        $node->tail = $this->build(...$items);

        return $node;
    }

    public function getIterator()
    {
        for ($node = $this->head; $node !== null; $node = $node->tail) {
            yield $node->value;
        }
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->count;
    }
}
