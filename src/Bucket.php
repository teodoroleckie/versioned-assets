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
        return $this->version->applyVersion($asset, $this->path);
    }

    /**
     * @inheritdoc
     */
    public function version(): string
    {
        return $this->version->version();
    }

    /**
     * @inheritdoc
     */
    public function path(): ?string
    {
        return $this->paths;
    }
}
