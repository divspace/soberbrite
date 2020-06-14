<?php

namespace App\Providers;

use App\Services\LookupService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class LookupServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(LookupService::class, static function (): LookupService {
            return new LookupService();
        });
    }

    public function provides(): array
    {
        return [LookupService::class];
    }
}
