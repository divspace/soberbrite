<?php

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Gets lookup data from CSV files and converts it to a collection that
 * can be used by seeders to populate the database.
 *
 * @see https://public.opendatasoft.com
 * @see https://github.com/stefangabos/world_countries
 * @see https://www.nationalnanpa.com/reports/area_code_relief_planning.html
 */
final class Lookup
{
    private array $lookups = [
        'areaCodes' => 'areaCodes',
        'cities' => 'zipCodes',
        'countries' => 'countries',
        'locations' => 'zipCodes',
        'states' => 'states',
        'zipCodes' => 'zipCodes',
    ];

    private Collection $csv;

    private Collection $data;

    private string $delimiter;

    public function __construct(string $method)
    {
        if (method_exists(self::class, $method)) {
            $fileName = Str::kebab($this->lookups[$method]).'.csv';
            $filePath = storage_path('csv/'.$fileName);

            if (file_exists($filePath)) {
                $this->csv = (new Collection(
                    file($filePath, FILE_IGNORE_NEW_LINES)
                ));

                $this->detectDelimiter($this->csv->shift());

                $this->csv->transform(function (string $line): array {
                    return str_getcsv($line, $this->delimiter);
                });

                $this->{$method}();
            }
        }
    }

    public function __destruct()
    {
        unset($this->csv, $this->data);
    }

    public function get(): Collection
    {
        return $this->data;
    }

    private function detectDelimiter(string $line): void
    {
        $delimiters = [
            ',' => 0,
            ';' => 0,
            '|' => 0,
        ];

        foreach ($delimiters as $delimiter => &$count) {
            $count = count(str_getcsv($line, $delimiter));
        }

        $this->delimiter = array_search(max($delimiters), $delimiters, true);
    }

    private function areaCodes(): void
    {
        $this->data = $this->csv->filter(function (array $item): bool {
            return strlen($item[8]) === 2 && $item[9] === 'US' && $item[10] === 'Y';
        })->mapToGroups(function (array $item): array {
            return [
                $item[8] => $item[0],
            ];
        })->sortKeys();
    }

    private function cities(): void
    {
        $this->locations();

        $this->data = $this->data->pluck('cityName')->unique()->sort();
    }

    private function countries(): void
    {
        $this->data = $this->csv->map(function (array $item): array {
            return [
                'code' => $item[2],
                'name' => $item[1],
            ];
        })->sortBy('name');
    }

    private function locations(): void
    {
        $this->data = $this->csv->map(function (array $item): array {
            return [
                'cityName' => $item[1],
                'stateCode' => $item[2],
                'zipCode' => $item[0],
                'latitude' => (float) $item[3],
                'longitude' => (float) $item[4],
                'timezoneOffset' => (int) $item[5],
                'observesDst' => (bool) $item[6],
            ];
        });
    }

    private function states(): void
    {
        $this->data = $this->csv->map(function (array $item): array {
            return [
                'code' => $item[0],
                'name' => $item[1],
            ];
        })->sortBy('name');
    }

    private function zipCodes(): void
    {
        $this->locations();

        $this->data = $this->data->pluck('zipCode')->sort();
    }
}
