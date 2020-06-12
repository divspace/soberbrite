<?php

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Gets lookup data from CSV or configuration files and converts it to a
 * collection that can be used by seeders to populate the database.
 *
 * @see https://public.opendatasoft.com
 * @see https://github.com/stefangabos/world_countries
 * @see https://www.nationalnanpa.com/reports/area_code_relief_planning.html
 */
final class Lookup
{
    private Collection $data;

    private Collection $file;

    public function __construct(string $type)
    {
        $config = Str::of($type)->slug()->__toString();
        $method = Str::of($type)->camel()->__toString();

        if (method_exists(self::class, $method)) {
            $filePath = $this->getFilePath($type);

            if (file_exists($filePath)) {
                $this->file = (new Collection(
                    file($filePath, FILE_IGNORE_NEW_LINES)
                ));

                $delimiter = $this->detectDelimiter($this->file->shift());

                $this->file->transform(static function (string $line) use ($delimiter): array {
                    return str_getcsv($line, $delimiter);
                });

                $this->{$method}();
            }
        } elseif (config()->has($config)) {
            $this->data = new Collection(config($config));
        }
    }

    public function fetch(): Collection
    {
        return $this->data;
    }

    private function getFilePath(string $name): ?string
    {
        return config()->has('lookup.tables.'.$name)
            ? config('lookup.tables.'.$name)['file_path']
            : null;
    }

    private function detectDelimiter(string $line): string
    {
        $delimiters = [
            ',' => 0,
            ';' => 0,
            '|' => 0,
        ];

        foreach ($delimiters as $delimiter => &$count) {
            $count = count(str_getcsv($line, $delimiter));
        }

        unset($count);

        return array_search(max($delimiters), $delimiters, true);
    }

    private function areaCodes(): void
    {
        $this->data = $this->file
            ->filter(static function (array $item): bool {
                return strlen($item[8]) === 2 && $item[9] === 'US' && $item[10] === 'Y';
            })
            ->mapToGroups(static function (array $item): array {
                return [
                    $item[8] => $item[0],
                ];
            })
            ->sortKeys();
    }

    private function cities(): void
    {
        $this->locations();

        $this->data = $this->data
            ->pluck('city')
            ->unique()
            ->sort()
            ->values()
            ->map(static function (string $city): array {
                return [
                    'name' => $city,
                ];
            });
    }

    private function countries(): void
    {
        $this->data = $this->file
            ->map(static function (array $item): array {
                return [
                    'code' => $item[2],
                    'name' => $item[1],
                ];
            })
            ->sortBy('name');
    }

    private function locations(): void
    {
        $this->data = $this->file
            ->map(static function (array $item): array {
                return [
                    'city' => $item[1],
                    'state' => $item[2],
                    'zip_code' => $item[0],
                    'latitude' => $item[3],
                    'longitude' => $item[4],
                    'timezone_offset' => $item[5],
                    'observes_dst' => $item[6],
                ];
            });
    }

    private function states(): void
    {
        $this->data = $this->file
            ->map(static function (array $item): array {
                return [
                    'code' => $item[0],
                    'name' => $item[1],
                ];
            })
            ->sortBy('name');
    }

    private function zipCodes(): void
    {
        $this->locations();

        $this->data = $this->data
            ->pluck('zip_code')
            ->sort()
            ->values()
            ->map(static function (string $zipCode): array {
                return [
                    'code' => $zipCode,
                ];
            });
    }
}
