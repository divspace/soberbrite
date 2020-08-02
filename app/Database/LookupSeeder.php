<?php

declare(strict_types = 1);

namespace App\Database;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

abstract class LookupSeeder extends Seeder
{
    public int $chunkSize = 100;

    protected Carbon $timestamp;

    protected Collection $insertData;

    public function __construct()
    {
        $this->timestamp = Carbon::now();

        $this->insertData = new Collection();
    }

    public function __destruct()
    {
        unset($this->insertData);
    }

    abstract public function run(): void;

    final public function getChunkSize(): int
    {
        return $this->chunkSize;
    }

    final public function setChunkSize(int $size): self
    {
        $this->chunkSize = $size;

        return $this;
    }

    final protected function insert(string $table): void
    {
        DB::table($table)->insert($this->insertData->toArray());
    }

    final protected function insertInChunks(string $table, ?int $size = null): void
    {
        if (isset($size)) {
            $this->setChunkSize($size);
        }

        foreach ($this->insertData->chunk($this->chunkSize) as $chunk) {
            DB::table($table)->insert($chunk->toArray());
        }
    }
}
