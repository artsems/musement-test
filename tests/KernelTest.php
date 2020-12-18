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

    public function testCities()
    {
        $cities = $this->kernel->cities();

        self::assertIsArray($cities);
        self::assertNotEmpty($cities);

        $city = reset($cities);

        $this->assertArrayStructure(['name', 'latitude', 'longitude'], array_keys($city));
    }

    public function testWeathers()
    {
        $weathers = $this->kernel->weathers($this->kernel->cities());

        self::assertIsArray($weathers);
        self::assertNotEmpty($weathers);

        $weather = reset($weathers);

        $this->assertIsString($weather);
    }
}