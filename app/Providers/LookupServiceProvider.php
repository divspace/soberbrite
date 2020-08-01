<?php

declare(strict_types = 1);

namespace App\Providers;

use App\Services\LookupService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

final class LookupServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(LookupService::class, static fn(): LookupService => new LookupService('LookupType'));
    }

    public function provides(): array
    {
        return [LookupService::class];
    }
}
