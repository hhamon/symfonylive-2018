<?php

namespace App\FileManager;

class ImageFileMetadata implements FileMetadata
{
    private $size;
    private $path;
    private $width;
    private $height;

    public function __construct(
        int $size,
        string $path,
        int $width,
        int $height
    ) {
        $this->size = $size;
        $this->path = $path;
        $this->width = $width;
        $this->height = $height;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getRealPath(): string
    {
        return $this->path;
    }

    public function getExtras(): array
    {
        $orientation = 'portrait';
        if ($this->width === $this->height) {
            $orientation = 'square';
        } elseif ($this->width > $this->height) {
            $orientation = 'landscape';
        }

        return [
            'width' => $this->width,
            'height' => $this->height,
            'orientation' => $orientation,
        ];
    }
}