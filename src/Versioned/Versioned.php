<?php

declare(strict_types=1);

namespace Tleckie\Assets\Versioned;

use function sprintf;

/**
 * Class Versioned
 *
 * @package  Tleckie\Assets\Versioned
 * @category Versioned
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class Versioned extends NullVersioned
{
    /**
     * Versioned constructor.
     *
     * @param string $version
     * @param string $format
     */
    public function __construct(string $version, string $format = "%s?%s")
    {
        $this->version = $version;
        $this->format = $format;
    }

    /**
     * @inheritdoc
     */
    public function applyVersion(string $asset, string $path): string
    {
        return sprintf(
            $this->format,
            $this->prepareFile($asset, $path),
            $this->version
        );
    }
}
