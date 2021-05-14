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
     * @param string $path
     * @param string $expected
     */
    public function check(string $asset, string $path, string $expected): void
    {
        $versioned = new NullVersioned();

        static::assertEquals($expected, $versioned->applyVersion($asset, $path));

        static::assertEmpty($versioned->version());
    }

    /**
     * @return string[][]
     */
    public function checkDataProvider(): array
    {
        return [
            ['/asset.css', '/path', '/asset.css'],
            ['asset.css', '/path', '/path/asset.css'],
            ['asset.css', '//www.statics.com/path', '//www.statics.com/path/asset.css'],
            ['asset.css', 'http://www.statics.com/path', 'http://www.statics.com/path/asset.css'],
            ['asset.css', 'https://www.statics.com/path', 'https://www.statics.com/path/asset.css'],
            ['/asset.css', 'https://www.statics.com/path', 'https://www.statics.com/path/asset.css'],
            ['/asset.css', '', '/asset.css'],
            ['asset.css', '', 'asset.css'],
        ];
    }
}
