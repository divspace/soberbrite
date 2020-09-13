<?php

declare(strict_types = 1);

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

final class RouteServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * @var string
     */
    private const API = 'api';

    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(static function (): void {
            Route::middleware(self::API)
                ->prefix(self::API)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for(self::API, static fn (Request $request): Limit => Limit::perMinute(60));
    }
}
