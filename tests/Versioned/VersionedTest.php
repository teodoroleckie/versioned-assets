<?php

declare(strict_types=1);

namespace Tleckie\Assets\Tests\Versioned;

use PHPUnit\Framework\TestCase;
use Tleckie\Assets\Versioned\Versioned;

/**
 * Class VersionedTest
 *
 * @package  Tleckie\Assets\Tests\Versioned
 * @category VersionedTest
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class VersionedTest extends TestCase
{
    /**
     * @test
     * @dataProvider  checkDataProvider
     * @param string $version
     * @param string $format
     * @param string $asset
     * @param string $expected
     */
    public function check(string $version, string $format, string $asset, string $expected): void
    {
        $versioned = new Versioned($version, $format);

        static::assertEquals($expected, $versioned->applyVersion($asset));

        static::assertEquals($version, $versioned->version());
    }

    /**
     * @return string[][]
     */
    public function checkDataProvider(): array
    {
        return [
            ['v1', '%s?%s', '/asset.css', '/asset.css?v1'],
            ['v1', '%2$s/%1$s', '/asset.css', 'v1/asset.css'],
            ['v1', '%s?%s', 'asset.css', 'asset.css?v1'],
            ['v1', '%2$s/%1$s', 'asset.css', 'v1/asset.css'],
        ];
    }
}
