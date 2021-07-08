<?php

declare(strict_types=1);

namespace Kollex\Services;

use Kollex\DataProvider\FileLoaderStrategyFactory;

class LoaderService extends AbstractLoaderService implements LoaderServiceInterface
{
    /**
     * Products List
     *
     * @var Product[]
     */
    private $products;
    /**
     * strategyFactory
     *
     * @var FileLoaderStrategyFactory
     */
    private $strategyFactory;
    /**
     * Loading Strategies
     *
     * @var DataProviderInterface[]
     */
    private $loaders = [];

    /**
     * __construct
     *
     * @param FileLoaderStrategyFactory $strategyFactory
     * @return void
     */
    public function __construct(FileLoaderStrategyFactory $strategyFactory)
    {
        $this->strategyFactory = $strategyFactory;
    }
    /**
     * Initialize Strategies to use
     *
     * @return void
     */
    public function init()
    {
        /**
         * Start
         */
        $this->loaders = [
            $this->strategyFactory->getLoadingStrategy('json'),
            $this->strategyFactory->getLoadingStrategy('csv'),
        ];
    }
    /**
     * Execute and extract and standardize products from files based on file types
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->loaders as $loader) {
            $this->products[] = $loader->getProducts();
        }
    }
    /**
     * Display Products in JSON format
     *
     * @return void
     */
    public function finish()
    {
        echo json_encode($this->products, JSON_PRETTY_PRINT);
        /**
         * End
         */
    }
}
