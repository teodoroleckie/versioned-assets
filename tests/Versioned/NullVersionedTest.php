<?php

declare(strict_types=1);

namespace Tleckie\Assets\Tests\Versioned;

use PHPUnit\Framework\TestCase;
use Tleckie\Assets\Versioned\NullVersioned;

/**
 * Class NullVersionedTest
 *
 * @package  Tleckie\Assets\Tests\Versioned
 * @category NullVersionedTest
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class NullVersionedTest extends TestCase
{
    /**
     * @test
     * @dataProvider  checkDataProvider
     * @param string $asset
     * @param string $expected
     */
    public function check(string $asset, string $expected): void
    {
        $versioned = new NullVersioned();

        static::assertEquals($expected, $versioned->applyVersion($asset));

        static::assertEmpty($versioned->version());
    }

    /**
     * @return string[][]
     */
    public function checkDataProvider(): array
    {
        return [
            ['/asset.css', '/asset.css'],
            ['asset.css', 'asset.css'],
            ['/path/asset.css', '/path/asset.css'],
            ['path/asset.css', 'path/asset.css'],
        ];
    }
}
