<?php

namespace App\Providers;

use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Reset the binded database manager and connection back to default.
     *
     * @see https://github.com/grimzy/laravel-mysql-spatial/issues/109
     */
    public function register(): void
    {
        $this->app->singleton('db.factory', function ($app): ConnectionFactory {
            return new ConnectionFactory($app);
        });

        $this->app->singleton('db', function ($app): DatabaseManager {
            return new DatabaseManager($app, $app['db.factory']);
        });
    }
}
