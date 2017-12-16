<?php

namespace Ephrin\Kind\Tests;

use Ephrin\Kind\MixedSet;
use PHPUnit\Framework\TestCase;

class MixedSetTest extends TestCase
{
    /**
     * @dataProvider iterations
     * @param array $data
     * @param mixed $result
     */
    public function testIterate(array $data, $result)
    {
        $set = new MixedSet(...$data);

        $return = iterator_to_array($set);

        $this->assertEquals($result, $return);
    }

    public function iterations()
    {
        yield 'simple' => [
            [1, 2, 3, 4, 5],
            [1, 2, 3, 4, 5]
        ];

        yield 'nulls' => [
            [1, null, null, null, 5],
            [1, null, null, null, 5],
        ];

        yield 'large' => [
            array_fill(0, 10000, null),
            array_fill(0, 10000, null),
        ];
    }

    /**
     * @dataProvider iterations
     * @param array $data
     */
    public function testCount(array $data){
        $c = new MixedSet(...$data);
        $this->assertEquals(\count($data), \count($c));
    }
}
