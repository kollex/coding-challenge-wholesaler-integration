<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use Kollex\App\Services\FileMetadata;
use PHPUnit\Framework\TestCase;

/**
 * @see FileMetadata
 */
class FileMetadataTest extends TestCase
{
    protected FileMetadata $fileMetadata;

    protected function setUp() : void
    {
        $this->fileMetadata = new FileMetadata();
    }

    public function testProcess()
    {
        $this->assertTrue(true);
    }

    public function testGetFileMetadataWithException(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $fileMetadata = $this->fileMetadata->getFileMetadata('filecsv');
    }

    /**
     *  @dataProvider filenamesProvider
     */
    public function testGetFileMetadata($filename, $fileExtension): void
    {
        $fileMetadata = $this->fileMetadata->getFileMetadata($filename);

        $this->assertEquals(
            $fileMetadata['fileExtensionNormalised'],
            $fileExtension,
            'Invalid File Extension'
        );
    }

    /**
     * @return \string[][]
     */
    public function filenamesProvider(): array
    {
        return [
            'filename with correct extension csv'   => ['file.csv', 'CSV'],
            'filename with correct extension json'  => ['file.json', 'JSON'],
            'filename with correct extension yaml'  => ['file.yaml', 'YAML'],
            'path with correct extension csv'       => ['path/to/file.csv', 'CSV'],
            'path with correct extension json'      => ['path/to/file.json', 'JSON'],
            'path with correct extension yaml'      => ['path/to/file.yaml', 'YAML'],
        ];
    }

    /**
     * @return void
     */
    protected function tearDown() : void
    {
    }
}