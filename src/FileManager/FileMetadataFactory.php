<?php

namespace App\FileManager;

interface FileMetadataFactory
{
    public function load(string $path): FileMetadata;
}