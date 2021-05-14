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
class Versioned implements VersionedInterface
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
    public function applyVersion(string $asset): string
    {
        return preg_replace(
            '#\/{2,}#',
            '/',
            sprintf($this->format, $asset, $this->version())
        );
    }

    /**
     * @inheritdoc
     */
    public function version(): string
    {
        return $this->version;
    }
}
