<?php

namespace Kollex\Command;

use Kollex\Service\FileTypeDetector;
use Kollex\Service\IngestorFactory;
use Kollex\Service\ParserFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class IngestDataCommand extends Command
{
    protected static $defaultName = 'kollex:ingest-data';

    protected function configure()
    {
        $this
            ->setDescription('Imports data from various sources and prepares an homogeneous repository')
            ->setHelp('With this command you can ingest many data formats and get it ready for consumption')
            ->addOption(
                'skipHeaderInCSV',
                's',
                InputOption::VALUE_OPTIONAL,
                'Do you want to skip the first row in CSV files? (Header row with column names)',
                true
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sfStyle = new SymfonyStyle($input, $output);
        $sfStyle->title('Welcome to the Kollex Data Ingestion Command');
        $sfStyle->section('Starting process');
        $dataLocation = __DIR__ . '/../../data/';
        $cacheLocation = __DIR__ . '/../../cache/';
        if (!is_dir($cacheLocation)) {
            $sfStyle->error('Cache location cannot be found');
            return Command::FAILURE;
        }
        if (!is_dir($dataLocation)) {
            $sfStyle->error('Data location cannot be found');
            return Command::FAILURE;
        }

        $filesToParse = scandir($dataLocation);
        if (empty($filesToParse)) {
            $sfStyle->error('No file to parse');
            return Command::FAILURE;
        }

        $products = [];
        foreach ($filesToParse as $file) {
            if (substr($file, 0, 1) === '.') {
                continue;
            }

            $detectedType = FileTypeDetector::getType($file);
            $detectedName = FileTypeDetector::getName($file);
            $parser = ParserFactory::getParser($detectedType);
            $ingestor = IngestorFactory::getIngestor($detectedName);

            $sfStyle->block('Starting to parse ' . $detectedType);

            $skipHeaderRows = filter_var($input->getOption('skipHeaderInCSV'), FILTER_VALIDATE_BOOLEAN);
            foreach ($parser->parseFile($dataLocation . $file) as $index => $rawProduct) {
                // skip first line in csv
                if ($detectedType === 'csv' && $index === 0 && $skipHeaderRows === true) {
                    $sfStyle->comment('Skipping row containing column titles');
                    continue;
                }
                $sfStyle->writeln('Processing ' . $index);
                $products[] = $ingestor->parseRowsIntoProducts($rawProduct);
            }
        }

        $sfStyle->success('All data parsed');
        $jsonProducts = json_encode($products);
        $cacheHandle = fopen($cacheLocation . 'assortment.json', 'w');
        $sfStyle->block('Writing output');
        if (fwrite($cacheHandle, $jsonProducts)) {
            fclose($cacheHandle);
            $sfStyle->success('All operations completed OK.');
            return Command::SUCCESS;
        }

        $sfStyle->error('Error writing output file.');
        fclose($cacheHandle);

        return Command::FAILURE;
    }
}
