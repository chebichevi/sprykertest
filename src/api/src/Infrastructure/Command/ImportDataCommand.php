<?php

declare(strict_types=1);

namespace App\Infrastructure\Command;

use App\Domain\Dao\ProductDao;
use App\Infrastructure\Fixtures\CsvFixtures;
/**
 * Class ImportDataCommand
 * @package App\Commands
 */
final class ImportDataCommand extends AbstractCommand
{
    /** @var string */
    protected static $defaultName = 'app:import-data';

    private ProductDao $productDao;

    private CsvFixtures $csvFixtures;

    /**
     * ImportDataCommand constructor.
     * @param ProductDao $productDao
     * @param CsvFixtures $csvFixtures
     */
    public function __construct(ProductDao $productDao, CsvFixtures $csvFixtures) 
    {
        parent::__construct();
        $this->productDao = $productDao;
        $this->csvFixtures = $csvFixtures;
        $this->commands = [
            new ImportProductData($this->productDao, $this->csvFixtures)
            
        ];
    }

    /**
     *
     */
    protected function configure(): void
    {
        $this->setDescription('Imports Products.');
    }
}
