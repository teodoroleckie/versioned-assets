<?php

declare(strict_types=1);

namespace Tleckie\Assets\Versioned;

/**
 * Interface VersionedInterface
 *
 * @package  Tleckie\Assets\Versioned
 * @category VersionedInterface
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
interface VersionedInterface
{
    /**
     * @return string
     */
    public function version(): string;

    /**
     * @param string $asset
     * @param string $path
     * @return string
     */
    public function applyVersion(string $asset, string $path): string;
}
