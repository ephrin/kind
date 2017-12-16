<?php

namespace Ephrin\Kind;

class MixedSet implements \IteratorAggregate, \Countable
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
        $this->head = $this->build(\func_num_args(), ...$items);
    }

    /**
     * @param int $acc
     * @param array ...$items
     * @return node|null
     */
    private function build(int $acc,  ...$items): ?node
    {
        if ($acc === 0) {
            return null;
        }
        $this->count++;
        $node = new node();
        $node->value = array_shift($items);
        $node->tail = $this->build($acc - 1, ...$items);

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
