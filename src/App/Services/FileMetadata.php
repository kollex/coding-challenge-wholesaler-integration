<?php

namespace Kollex\App\Services;

class FileMetadata
{
    private const FILE_EXTENSION = 'extension';

    public function __construct()
    {
    }

    /**
     * @param string $filename
     *
     * @return array
     */
    public function getFileMetadata(string $filename): array
    {
        $fileMetadata = $this->getPathInfo($filename);

        if (empty($fileMetadata[self::FILE_EXTENSION]))
            throw new \InvalidArgumentException(\sprintf('There is no extension for filename %s', $filename));

        $fileExtensionNormalised = $this->getNormalisedFileExtension($fileMetadata[SELF::FILE_EXTENSION]);

        $fileMetadata['fileExtensionNormalised'] = $fileExtensionNormalised;
        $fileMetadata['fileHandlerType'] = \sprintf(
            '%sHandler',
            $fileExtensionNormalised
        );

        return $fileMetadata;
    }

    /**
     * It normalises in uppercase the file extension, so it can be assigned programmatically a file handler for it
     *
     * @param string $fileExtension
     *
     * @return string
     */
    private function getNormalisedFileExtension(string $fileExtension) : string
    {
        return \strtoupper($fileExtension);
    }

    /**
     * @param string $filePath
     *
     * @return array
     */
    protected function getPathInfo(string $filePath) : array
    {
        return \pathinfo($filePath);
    }
}