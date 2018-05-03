<?php

namespace App\FileManager;

interface FileMetadata
{
    public function getSize(): int;

    public function getRealPath(): string;

    public function getExtras(): array;
}