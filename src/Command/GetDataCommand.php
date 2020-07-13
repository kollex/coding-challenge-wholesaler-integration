<?php

namespace Kollex\Command;

use JsonStreamingParser\Parser;
use Kollex\Service\CacheService;
use Kollex\Service\FileTypeDetector;
use Kollex\Service\IngestorFactory;
use Kollex\Service\ParserFactory;
use Kollex\Service\RowListener\RowListener;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GetDataCommand extends Command
{
    protected static $defaultName = 'kollex:get-data';

    protected function configure()
    {
        $this
            ->setDescription('Gets data from the cache')
            ->setHelp('With this command you can get the assortment data')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sfStyle = new SymfonyStyle($input, $output);
        $sfStyle->title('Welcome to the Kollex Data Search Command');
        $cacheLocation = __DIR__ . '/../../cache/';
        if (!is_dir($cacheLocation)) {
            $sfStyle->error('Cache location cannot be found');
            return Command::FAILURE;
        }

        $filesToParse = scandir($cacheLocation);
        if (empty($filesToParse)) {
            $sfStyle->error('No data file to parse');
            return Command::FAILURE;
        }

        foreach ($filesToParse as $file) {
            if (substr($file, 0, 1) === '.') {
                continue;
            }
            $contents = file_get_contents($cacheLocation . $file);
            if (json_last_error() === JSON_ERROR_NONE) {
                // no decoding problems found
                $sfStyle->text($contents);
            }
        }

        return Command::SUCCESS;
    }
}
