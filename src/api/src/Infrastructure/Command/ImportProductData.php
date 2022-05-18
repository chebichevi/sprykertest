<?php

declare(strict_types=1);

namespace App\Infrastructure\Command;

use App\Domain\Dao\ProductDao;
use App\Domain\Model\Product;
use App\Infrastructure\Fixtures\CsvFixtures;

use function explode;

final class ImportProductData implements Command
{
    private const PRODUCT_FILE_PATH = __DIR__ . '/../../../etc/default/example_data.csv';

    private ProductDao $productDao;

    private CsvFixtures $csvFixtures;

    public function __construct(
        ProductDao $productDao,
        CsvFixtures $csvFixtures
    ) {
        $this->productDao  = $productDao;
        $this->csvFixtures = $csvFixtures;
    }

    public function up(): void
    {
        $this->importProductData($this->productDao, $this->csvFixtures);
    }

    private function importProductData(ProductDao $productDao, CsvFixtures $csvFixtures): void
    {
        $data = $csvFixtures->readCsv(self::PRODUCT_FILE_PATH);

        foreach ($data as $key => $value) {
            $field         = explode(';', $value['Id;product_name;part_number;prize']);
            $importProduct = $this->productDao->findProductByProductId($field[0], $field[1]);

            if ($importProduct) {
                $importProduct->setProductId($field[0]);
                $importProduct->setProductName($field[1]);
                $importProduct->setPartNumber($field[2]);
                $importProduct->setPrice($field[3]);

                $this->productDao->save($importProduct);
            } else {
                $importProduct = new Product(
                    $field[0],
                    $field[1],
                    $field[2],
                    $field[3]
                );
            }

            $this->productDao->save($importProduct);
        }
    }

    public function getName(): string
    {
        return 'Import Products Data';
    }
}
