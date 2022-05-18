<?php

declare(strict_types=1);

namespace App\Infrastructure\Command;

use App\Domain\Dao\ProductDao;
use App\Infrastructure\Fixtures\CsvFixtures;

final class ImportDataCommand extends AbstractCommand
{
    //protected static string $defaultName = 'app:import-data';

    private ProductDao $productDao;

    private CsvFixtures $csvFixtures;

    public function __construct(ProductDao $productDao, CsvFixtures $csvFixtures)
    {
        parent::__construct();
        $this->productDao  = $productDao;
        $this->csvFixtures = $csvFixtures;
        $this->commands    = [
            new ImportProductData($this->productDao, $this->csvFixtures),

        ];
    }

    protected function configure(): void
    {
        $this->setDescription('Imports Products.');
    }
}
