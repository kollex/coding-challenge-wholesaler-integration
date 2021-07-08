<?php

namespace Tests;

use Kollex\Services\FileReaderServiceInterface;
use PHPUnit\Framework\TestCase;

class FileReaderServiceTest extends TestCase
{
    use bootstrapApp;

    protected function setUp(): void
    {
        $this->initApp();
        $this->fileReader = $this->container->get(FileReaderServiceInterface::class);
    }

    public function testFileReaderServiceInstanciatedCorrectly()
    {
        $this->assertInstanceOf(FileReaderServiceInterface::class, $this->fileReader);
    }
    public function testReturnsFileCorrectly()
    {
        $this->assertIsString($this->fileReader->readfile(__DIR__ . '/fixtures/dummy.txt'));
        $this->assertEquals($this->fileReader->readfile(__DIR__ . '/fixtures/dummy.txt'), "Hello World");
    }
}
