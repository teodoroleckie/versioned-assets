<?php

declare(strict_types=1);

namespace Tleckie\Assets\Versioned;

use function sprintf;
use function str_contains;
use function str_starts_with;

/**
 * Class NullVersioned
 *
 * @package  Tleckie\Assets\Versioned
 * @category NullVersioned
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class NullVersioned implements VersionedInterface
{
    /**
     * @var string
     */
    protected string $version = '';

    /**
     * @var string
     */
    protected string $format = '';

    /**
     * @inheritdoc
     */
    public function version(): string
    {
        return $this->version;
    }

    /**
     * @inheritdoc
     */
    public function applyVersion(string $asset, string $path): string
    {
        return $this->prepareFile($asset, $path);
    }

    /**
     * @param string $asset
     * @param string $path
     * @return string
     */
    protected function prepareFile(string $asset, string $path): string
    {
        if ($this->hasScheme($path)) {
            return $path . ($this->isAbsolute($asset) ? $asset : sprintf('/%s', $asset));
        }

        if ($this->isAbsolute($asset)) {
            return $asset;
        }

        if (empty($path)) {
            return $asset;
        }

        return $path . sprintf('/%s', $asset);
    }

    /**
     * @param string $path
     * @return bool
     */
    private function hasScheme(string $path): bool
    {
        return str_contains($path, '://') || str_starts_with($path, '//');
    }

    /**
     * @param string $asset
     * @return bool
     */
    private function isAbsolute(string $asset)
    {
        return str_starts_with($asset, '/');
    }
}
