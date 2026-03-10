<?php

declare(strict_types=1);

namespace App\Providers;

use App\Infrastructure\Repositories\UserRepository;
use App\Application\Contracts\Repositories\UserRepositoryInterface;
use App\Infrastructure\Services\TenantConfigService;
use App\Application\Contracts\Services\TenantConfigServiceInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Application Service Provider
 * 
 * Binds interfaces to their implementations for dependency injection.
 * Following Clean Architecture principles - inner layers don't depend on outer layers.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * Binds contracts to implementations.
     */
    public function register(): void
    {
        // Repository bindings
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        // Service bindings
        $this->app->singleton(
            TenantConfigServiceInterface::class,
            TenantConfigService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Enable query logging in debug mode
        if (config('app.debug')) {
            DB::listen(function ($query) {
                Log::channel('daily')->debug('SQL Query', [
                    'sql' => $query->sql,
                    'bindings' => $query->bindings,
                    'time' => $query->time . 'ms',
                ]);
            });
        }
    }
}
