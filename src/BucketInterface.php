<?php

declare(strict_types=1);

namespace Tleckie\Assets;

/**
 * Interface BucketInterface
 *
 * @package  Tleckie\Assets
 * @category BucketInterface
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
interface BucketInterface
{
    /**
     * @param string $asset
     * @return string
     */
    public function url(string $asset): string;

    /**
     * @return string
     */
    public function version(): string;

    /**
     * @return string|null
     */
    public function path(): ?string;
}
