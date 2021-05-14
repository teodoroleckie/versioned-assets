<?php

declare(strict_types=1);

namespace Tleckie\Assets\Tests\Bucket;

use PHPUnit\Framework\TestCase;
use Tleckie\Assets\Bucket;
use Tleckie\Assets\Versioned\Versioned;

/**
 * Class BucketTest
 *
 * @package  Tleckie\Assets\Tests\Bucket
 * @category BucketTest
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class BucketTest extends TestCase
{
    /**
     * @test
     * @dataProvider  checkDataProvider
     * @param string $version
     * @param string $format
     * @param string $asset
     * @param string $path
     * @param string $expected
     */
    public function check(string $version, string $format, string $asset, string $path, string $expected): void
    {
        $versioned = new Bucket(new Versioned($version, $format), $path);

        static::assertEquals($expected, $versioned->url($asset));

        static::assertEquals($version, $versioned->version());
    }

    public function checkDataProvider(): array
    {
        return [
            ['v1', '%s?%s', '/asset.css', '/path', '/asset.css?v1'],
            ['v1', '%s?%s', '/asset.css', '/path/', '/asset.css?v1'],
            ['v1', '%s?%s', 'asset.css', '/path', '/path/asset.css?v1'],
            ['v1', '%s?%s', 'asset.css', '/path/', '/path/asset.css?v1'],
            ['v1', '%s?%s', 'asset.css', '//www.statics.com/path', '//www.statics.com/path/asset.css?v1'],
            ['v1', '%s?%s', 'asset.css', 'http://www.statics.com/path', 'http://www.statics.com/path/asset.css?v1'],
            ['v1', '%s?%s', 'asset.css', 'https://www.statics.com/path', 'https://www.statics.com/path/asset.css?v1'],
            ['v1', '%s?%s', '/asset.css', 'https://www.statics.com/path', 'https://www.statics.com/path/asset.css?v1'],
            ['v1', '%s?%s', '/asset.css', '', '/asset.css?v1'],
            ['v1', '%s?%s', 'asset.css', '', 'asset.css?v1'],
        ];
    }
}
