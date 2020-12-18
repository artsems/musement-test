<?php

namespace tests;

use \PHPUnit\Framework\TestCase as PHPUnitTestCase;

class TestCase extends PHPUnitTestCase
{
    /**
     * @param string[] $expected
     * @param string[] $actual
     */
    public function assertArrayStructure(array $expected, array $actual): void
    {
        self::assertSame(0, count(array_diff($expected, $actual)));
    }
}
