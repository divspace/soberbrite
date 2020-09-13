<?php

declare(strict_types = 1);

namespace App\Services;

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
final class LookupService
{
    /**
     * @var string
     */
    private const NAME = 'name';

    /**
     * @var string
     */
    private const CODE = 'code';

    private Collection $data;

    private Collection $file;

    public static array $delimiters = [
        ',' => 0,
        ';' => 0,
        '|' => 0,
    ];

    public function __construct(string $type)
    {
        $config = Str::slug($type);
        $method = Str::camel($type);

        if (method_exists(self::class, $method)) {
            $filePath = $this->getFilePath($type);

            if (file_exists($filePath)) {
                $this->file = (new Collection(
                    file($filePath, FILE_IGNORE_NEW_LINES)
                ));

                $delimiter = $this->detectDelimiter($this->file->shift());

                $this->file->transform(static fn (string $line): array => str_getcsv($line, $delimiter));

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

    public function areaCodes(): void
    {
        $this->data = $this->file
            ->filter(static fn (array $item): bool => \mb_strlen($item[8]) === 2 && $item[9] === 'US' && $item[10] === 'Y')
            ->mapToGroups(static fn (array $item): array => [
                $item[8] => $item[0],
            ])
            ->sortKeys();
    }

    public function cities(): void
    {
        $this->locations();

        $this->data = $this->data
            ->pluck('city')
            ->unique()
            ->sort()
            ->values()
            ->map(static fn (string $city): array => [
                self::NAME => $city,
            ]);
    }

    public function countries(): void
    {
        $this->data = $this->file
            ->map(static fn (array $item): array => [
                self::CODE => $item[2],
                self::NAME => $item[1],
            ])
            ->sortBy(self::NAME);
    }

    public function locations(): void
    {
        $this->data = $this->file
            ->map(static fn (array $item): array => [
                'city' => $item[1],
                'state' => $item[2],
                'zip_code' => $item[0],
                'latitude' => $item[3],
                'longitude' => $item[4],
                'timezone_offset' => $item[5],
                'observes_dst' => $item[6],
            ]);
    }

    public function states(): void
    {
        $this->data = $this->file
            ->map(static fn (array $item): array => [
                self::CODE => $item[0],
                self::NAME => $item[1],
            ])
            ->sortBy(self::NAME);
    }

    public function zipCodes(): void
    {
        $this->locations();

        $this->data = $this->data
            ->pluck('zip_code')
            ->sort()
            ->values()
            ->map(static fn (string $zipCode): array => [
                self::CODE => $zipCode,
            ]);
    }

    private function getFilePath(string $name): string
    {
        return config()->has('lookup.tables.'.$name)
            ? config('lookup.tables.'.$name)['file_path']
            : '';
    }

    private function detectDelimiter(string $line): string
    {
        foreach (self::$delimiters as $delimiter => &$count) {
            $count = count(str_getcsv($line, $delimiter));
        }

        unset($count);

        return array_search(max(self::$delimiters), self::$delimiters, true);
    }
}
