<?php

namespace App\Database;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LookupSeeder extends Seeder
{
    public int $chunkSize = 100;

    protected Carbon $timestamp;

    protected Collection $insertData;

    public function __construct()
    {
        $this->timestamp = Carbon::now();
    }

    public function __destruct()
    {
        unset($this->insertData);
    }

    public function getChunkSize(): int
    {
        return $this->chunkSize;
    }

    public function setChunkSize(int $size): void
    {
        $this->chunkSize = $size;
    }

    protected function insert(string $table): void
    {
        DB::table($table)->insert($this->insertData->toArray());
    }

    protected function insertInChunks(string $table, ?int $size = null): void
    {
        if (isset($size)) {
            $this->setChunkSize($size);
        }

        foreach ($this->insertData->chunk($this->chunkSize) as $chunk) {
            DB::table($table)->insert($chunk->toArray());
        }
    }
}
