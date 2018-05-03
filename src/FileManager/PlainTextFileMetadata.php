<?php

namespace App\FileManager;

class PlainTextFileMetadata implements FileMetadata
{
    private $size;
    private $path;
    private $numberOfLines;

    public function __construct(int $size, string $path, int $numberOfLines)
    {
        $this->size = $size;
        $this->path = $path;
        $this->numberOfLines = $numberOfLines;
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
        return [
            'numberOfLines' => $this->numberOfLines,
        ];
    }
}