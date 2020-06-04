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
final class LookupCollection
{
    private Collection $lookupFiles;

    private array $lookupTypes = [
        'areaCodes',
        'countries',
        'states',
        'zipCodes',
    ];

    private string $fileDirectory = 'csv';

    private string $fileExtension = 'csv';

    public function __construct()
    {
        $this->lookupFiles = $this->getLookupFiles();
    }

    public function getCities(): Collection
    {
        return $this->getLocations()
            ->pluck('cityName')
            ->unique()
            ->sort();
    }

    public function getZipCodes(): Collection
    {
        return $this->getLocations()
            ->pluck('zipCode')
            ->sort();
    }

    public function getStates(): Collection
    {
        $data = collect();

        $file = fopen($this->lookupFiles['states'], 'r');

        fgetcsv($file, 25, ';');

        while (($row = fgetcsv($file, 25, ';')) !== false) {
            $data->push([
                'code' => $row[0],
                'name' => $row[1],
            ]);
        }

        fclose($file);

        return $data->sortBy('name');
    }

    public function getLocations(): Collection
    {
        $data = collect();

        $file = fopen($this->lookupFiles['zipCodes'], 'r');

        fgetcsv($file, 100, ';');

        while (($row = fgetcsv($file, 100, ';')) !== false) {
            $data->push([
                'cityName' => $row[1],
                'stateCode' => $row[2],
                'zipCode' => $row[0],
                'latitude' => (float) $row[3],
                'longitude' => (float) $row[4],
                'timezoneOffset' => (int) $row[5],
                'observesDst' => (bool) $row[6],
            ]);
        }

        fclose($file);

        return $data;
    }

    public function getAreaCodes(): Collection
    {
        $data = collect();

        $file = fopen($this->lookupFiles['areaCodes'], 'r');

        fgetcsv($file, 450, ',');

        while (($row = fgetcsv($file, 450, ',')) !== false) {
            if (strlen($row[8]) === 2 && $row[9] === 'US' && $row[10] === 'Y') {
                $data->push([
                    'code' => $row[0],
                    'stateCode' => $row[8],
                ]);
            }
        }

        fclose($file);

        return $data->sortBy('code');
    }

    public function getCountries(): Collection
    {
        $data = collect();

        $file = fopen($this->lookupFiles['countries'], 'r');

        fgetcsv($file, 75, ',');

        while (($row = fgetcsv($file, 75, ',')) !== false) {
            $data->push([
                'code' => $row[2],
                'name' => $row[1],
            ]);
        }

        fclose($file);

        return $data->sortBy('name');
    }

    public function setLookupTypes(array $lookupTypes): void
    {
        $this->lookupTypes = $lookupTypes;
    }

    public function setFileDirectory(string $fileDirectory): void
    {
        $this->fileDirectory = $fileDirectory;
    }

    public function setFileExtension(string $fileExtension): void
    {
        $this->fileExtension = $fileExtension;
    }

    private function getFileDirectory(): string
    {
        return $this->fileDirectory;
    }

    private function getFileExtension(): string
    {
        return $this->fileExtension;
    }

    private function getFilePath(string $fileName): string
    {
        $fileName = Str::kebab($fileName).'.'.$this->getFileExtension();

        return storage_path($this->getFileDirectory().'/'.$fileName);
    }

    private function getLookupFiles(): Collection
    {
        $data = collect();

        foreach ($this->lookupTypes as $type) {
            $data->put($type, $this->getFilePath($type));
        }

        return $data;
    }
}
