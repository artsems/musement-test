<?php declare(strict_types = 1);

namespace tests;

use Musement\Kernel;

final class KernelTest extends TestCase
{
    private Kernel $kernel;

    public function setUp(): void
    {
        $this->kernel = new Kernel();
    }

    public function testCities(): void
    {
        $cities = $this->kernel->cities();

        self::assertIsArray($cities);
        self::assertNotEmpty($cities);

        $this->assertArrayStructure(['name', 'latitude', 'longitude'], array_keys($cities[0]));
    }

    public function testWeathers(): void
    {
        $weathers = $this->kernel->weathers($this->kernel->cities());

        self::assertIsArray($weathers);
        self::assertNotEmpty($weathers);

        $this->assertIsString($weathers[0]);
    }
}
