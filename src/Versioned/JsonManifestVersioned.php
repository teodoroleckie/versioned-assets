<?php

declare(strict_types=1);

namespace Tleckie\Assets\Versioned;

use InvalidArgumentException;
use JsonException;
use function file_get_contents;
use function json_decode;

/**
 * Class JsonManifestVersioned
 *
 * @package  Tleckie\Assets\Versioned
 * @category JsonManifestVersioned
 * @author   Teodoro Leckie Westberg <teodoroleckie@gmail.com>
 */
class JsonManifestVersioned extends NullVersioned
{
    /**
     * @var array
     */
    protected array $data;

    /**
     * JsonManifestVersioned constructor.
     *
     * @param string $manifestPath
     * @throws JsonException|InvalidArgumentException
     */
    public function __construct(string $manifestPath)
    {
        if (!is_file($manifestPath)) {
            throw new InvalidArgumentException(
                sprintf('File [%s] not found.', $manifestPath)
            );
        }

        $this->data = json_decode(
            file_get_contents($manifestPath),
            true,
            2,
            JSON_THROW_ON_ERROR
        );
    }

    /**
     * @inheritdoc
     */
    public function applyVersion(string $asset, string $path): string
    {
        if (isset($this->data[$asset])) {
            $asset = $this->data[$asset];
        }

        return $this->prepareFile($asset, $path);
    }
}
