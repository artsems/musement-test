<?php

namespace tests;

use \PHPUnit\Framework\TestCase as PHPUnitTestCase;

class TestCase extends PHPUnitTestCase
{
    public function assertArrayStructure(array $expected, array $actual)
    {
        self::assertSame(0, count(array_diff($expected, $actual)));
    }
}