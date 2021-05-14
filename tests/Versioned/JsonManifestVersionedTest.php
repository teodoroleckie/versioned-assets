<?php

declare(strict_types=1);

namespace Tleckie\Assets\Tests\Versioned;

use InvalidArgumentException;
use JsonException;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit\Framework\TestCase;
use Tleckie\Assets\Versioned\JsonManifestVersioned;

/**
 * Class JsonManifestVersionedTest
 *
 * @package  Tleckie\Assets\Tests\Versioned
 * @category JsonManifestVersionedTest
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class JsonManifestVersionedTest extends TestCase
{
    /**
     * @var vfsStreamDirectory
     */
    private vfsStreamDirectory $path;

    /**
     * @test
     * @dataProvider  checkDataProvider
     * @param string $asset
     * @param string $expected
     * @throws JsonException
     */
    public function check(string $asset, string $expected): void
    {
        $versioned = new JsonManifestVersioned($this->path->url() . '/json/rev-manifest.json');

        static::assertEquals($expected, $versioned->applyVersion($asset));

        static::assertEmpty($versioned->version());
    }

    /**
     * @test
     * @throws InvalidArgumentException|JsonException
     */
    public function fileNotFoundThrowException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf(
                'File [%s] not found.',
                $this->path->url() . '/invalid/json/rev-manifest.json'
            )
        );

        new JsonManifestVersioned($this->path->url() . '/invalid/json/rev-manifest.json');
    }

    /**
     * @test
     * @throws JsonException
     */
    public function throwJsonException(): void
    {
        $this->expectException(JsonException::class);
        $this->expectExceptionMessage('Syntax error');

        new JsonManifestVersioned($this->path->url() . '/json/rev-manifest-error.json');
    }

    /**
     * @return string[][]
     */
    public function checkDataProvider(): array
    {
        return [
            ['css/asset.css', 'build/css/app.a9b916426ea1d10021f3f17ce8031f93c2.css'],
            ['/css/asset.css', '/css/asset.css'],
            ['css/asset.css', 'build/css/app.a9b916426ea1d10021f3f17ce8031f93c2.css'],
            ['css/asset.css', 'build/css/app.a9b916426ea1d10021f3f17ce8031f93c2.css'],
            ['css/asset.css', 'build/css/app.a9b916426ea1d10021f3f17ce8031f93c2.css'],
            ['/asset.css', '/asset.css'],
            ['asset.css', 'asset.css'],
        ];
    }

    protected function setUp(): void
    {
        $this->path = vfsStream::setup(
            'root',
            null,
            ['json' =>
                [
                    'rev-manifest.json' => '{"css/asset.css": "build/css/app.a9b916426ea1d10021f3f17ce8031f93c2.css"}',
                    'rev-manifest-error.json' => '{asset.css": "content"}'
                ]
            ]
        );
    }
}
