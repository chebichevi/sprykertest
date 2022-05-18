<?php

declare(strict_types=1);

namespace App\Infrastructure\Command;

use App\Entity\Product;
use App\Domain\Dao\ProductDao;
use App\Infrastructure\Fixtures\CsvFixtures;

use function strval;

/**
 * Class ImportProductData
 * @package App\Commands
 */
final class ImportProductData implements Command
{
    private const PRODUCT_FILE_PATH = __DIR__ . '/../../../etc/default/example_data.csv';

    private ProductDao $productDao;

    private CsvFixtures $csvFixtures;

    /**
     * ImportProductData constructor.
     * 
     * @param ProductDao $productDao
     */
    public function __construct(
        ProductDao $productDao,
        CsvFixtures $csvFixtures
    )
    {
        $this->productDao = $productDao;
        $this->csvFixtures = $csvFixtures;
    }

    /**
     *
     */
    public function up(): void
    {
        $this->importProductData($this->productDao, $this->csvFixtures);
    }

    /**
     * @param ProductDao $productDao
     * @param CsvFixtures $csvFixtures
     */
    private function importProductData($productDao, $csvFixtures): void
    {
        $data = $csvFixtures->readCsv(self::PRODUCT_FILE_PATH);
        
        foreach ($data as $key => $value) {
            $importProduct = $this->productDao->getById($value['Id']);

            if($importProduct){
                $this->productDao->delete($importProduct);
            }else{
                $importProduct = new Product(
                    $value['product_name'], 
                    $value['part_number'],
                    $value['prize']
                );
            }

            $this->productDao->save($importProduct);
        }
                
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Import Products Data';
    }
}