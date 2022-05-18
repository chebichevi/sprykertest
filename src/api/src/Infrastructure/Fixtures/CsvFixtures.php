<?php

declare(strict_types=1);

namespace App\Infrastructure\Fixtures;

use function array_shift;
use function feof;
use function fgetcsv;
use function is_array;
use function Safe\fopen;

class CsvFixtures
{
    /**
     * @return array<array<string>>
     */
    public function readCsv(string $filePath, bool $matrix = false): array
    {
        $file = fopen($filePath, 'r');

        $header = fgetcsv($file);
        if (! is_array($header)) {
            return [];
        }

        $csv = [];
        while (! feof($file)) {
            $line = fgetcsv($file);
            if (! $line) {
                continue;
            }

            $item = [];
            foreach ($line as $i => $cell) {
                $item[$header[$i]] = $cell;
            }

            if ($matrix) {
                $csv[array_shift($item)] = $item;
            } else {
                $csv[] = $item;
            }
        }

        return $csv;
    }
}
