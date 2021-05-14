<?php

declare(strict_types=1);

namespace Tleckie\Assets\Versioned;

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
    public function applyVersion(string $asset): string
    {
        return $asset;
    }
}
