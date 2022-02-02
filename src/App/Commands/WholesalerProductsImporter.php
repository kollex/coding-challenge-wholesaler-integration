<?php

declare(strict_types=1);

namespace Kollex\App\Commands;

use Kollex\App\Services\ProductsImporter\ProductsImporter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command class to import products
 */
class WholesalerProductsImporter extends Command
{
    private const DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * @param ProductsImporter $productsImporter
     *
     * @param string|null $name
     */
    public function __construct(
        private ProductsImporter $productsImporter,
        string $name = null
    )
    {
        parent::__construct($name);
    }

    /**
     * @return void
     */
    protected function configure() : void
    {
        $helpMessageList[] = 'It imports product information from different sources in different data formats.';

        $this->setName('wholesaler-products-importer')
            ->setDescription($helpMessageList[0])
            ->setHelp(\implode(\PHP_EOL, $helpMessageList));
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @throws \FileHandlerNotFoundException (Custom Exception)
     * @throws \Exception
     *
     * @return int The command's exit success or failure
     */
    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $output->writeln(
            \sprintf(
                'Starting importing at %s',
                \date(SELF::DATE_FORMAT)
            )
        );

        try {
            $productsCollection = $this->productsImporter->process();

            /**
             * @Todo:
             *     In case of success, it persists collection in db and move file to 'processed' folder
             */

            /**
             * @Todo:
             *     In case of any failure, rollback everything in the given file and move file to 'rejected' folder
             */
        } catch (\Exception $e) {
            /**
             * @Todo:
             *     Log error message
             *     Display error message
             */

            return Command::FAILURE;
        }

        $output->writeln(
            \sprintf(
                'Importing complete successfully at %s',
                \date(SELF::DATE_FORMAT)
            )
        );

        return Command::SUCCESS;
    }
}