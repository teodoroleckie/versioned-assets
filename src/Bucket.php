<?php

declare(strict_types=1);

namespace Tleckie\Assets;

use Tleckie\Assets\Versioned\VersionedInterface;
use function rtrim;

/**
 * Class Bucket
 *
 * @package  Tleckie\Assets
 * @category Bucket
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class Bucket implements BucketInterface
{
    /**
     * @var VersionedInterface
     */
    protected VersionedInterface $version;

    /**
     * @var string
     */
    protected string $path;

    /**
     * Bucket constructor.
     *
     * @param VersionedInterface $version
     * @param string             $path
     */
    public function __construct(VersionedInterface $version, string $path = '')
    {
        $this->version = $version;
        $this->path = rtrim($path, '/');
    }

    /**
     * @inheritdoc
     */
    public function url(string $asset): string
    {
        $versioned = ltrim($this->version->applyVersion($asset), '/');

        if ($this->hasScheme($this->path())) {
            return sprintf("%s/%s", $this->path(), $versioned);
        }

        if ($this->isAbsolute($asset)) {
            return sprintf('/%s', $versioned);
        }

        if (empty($this->path)) {
            return $versioned;
        }

        return sprintf("%s/%s", $this->path(), $versioned);
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
     * @inheritdoc
     */
    public function path(): ?string
    {
        return $this->path;
    }

    /**
     * @param string $asset
     * @return bool
     */
    private function isAbsolute(string $asset)
    {
        return str_starts_with($asset, '/');
    }

    /**
     * @inheritdoc
     */
    public function version(): string
    {
        return $this->version->version();
    }
}
