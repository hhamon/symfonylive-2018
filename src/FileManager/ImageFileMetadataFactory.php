<?php

namespace App\FileManager;

class ImageFileMetadataFactory implements FileMetadataFactory
{
    public function load(string $path): FileMetadata
    {
        if (!is_readable($path)) {
            throw new \InvalidArgumentException(sprintf('File %s is not readable', $path));
        }

        $fileInfo = new \SplFileInfo($path);
        $sizes = @getimagesize($fileInfo->getRealPath());

        return new ImageFileMetadata(
            $fileInfo->getSize(),
            $fileInfo->getRealPath(),
            $sizes[0],
            $sizes[1]
        );
    }
}