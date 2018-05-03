<?php

namespace App\Tests\FileManager;

use App\FileManager\PlainTextFileMetadata;
use App\FileManager\PlainTextFileMetadataFactory;
use PHPUnit\Framework\TestCase;

class PlainTextFileMetadataFactoryTest extends TestCase
{
    public function testLoadPlainTextMetadata(): void
    {
        $factory = new PlainTextFileMetadataFactory();
        $metadata = $factory->load(__DIR__.'/sample.txt');

        $this->assertInstanceOf(PlainTextFileMetadata::class, $metadata);
        $this->assertSame(11, $metadata->getSize());
        $this->assertSame(__DIR__.'/sample.txt', $metadata->getRealPath());
        $this->assertSame(
            ['numberOfLines' => 3],
            $metadata->getExtras()
        );
    }
}