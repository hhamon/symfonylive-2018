<?php

namespace App\FileManager;

class PlainTextFileMetadataFactory implements FileMetadataFactory
{
    public function load(string $path): FileMetadata
    {
        if (!is_readable($path)) {
            throw new \InvalidArgumentException(sprintf('File %s is not readable', $path));
        }

        $fileInfo = new \SplFileInfo($path);

        return new PlainTextFileMetadata(
            $fileInfo->getSize(),
            $fileInfo->getRealPath(),
            count(file($fileInfo->getRealPath()))
        );
    }
}