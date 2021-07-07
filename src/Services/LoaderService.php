<?php

declare(strict_types=1);

namespace Kollex\Services;

use Kollex\DataProvider\FileLoaderStrategyFactory;

class LoaderService extends AbstractLoaderService implements LoaderServiceInterface
{
    private $products;
    private $data;
    private $strategyFactory;

    public function __construct(FileLoaderStrategyFactory $strategyFactory)
    {
        $this->strategyFactory = $strategyFactory;
    }
    public function init()
    {
        echo "Start </br>";
    }
    public function run()
    {
        $strategy = $this->strategyFactory->getLoadingStrategy("json");
        $this->data = $strategy->getProducts();
    }
    public function finish()
    {
        echo json_encode($this->data["data"], JSON_PRETTY_PRINT);
    }
}
