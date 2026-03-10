<?php

declare(strict_types=1);

namespace App\Infrastructure\Services;

use App\Application\Contracts\Services\TenantConfigServiceInterface;

/**
 * Tenant Config Service
 * 
 * Resolves tenant-specific configuration from the environment / database.
 * In a full implementation this would look up tenant rows from a central registry.
 */
class TenantConfigService implements TenantConfigServiceInterface
{
    public function getTenantId(): string|int|null
    {
        return config('tenant.id');
    }

    public function getTenantName(): ?string
    {
        return config('tenant.name');
    }

    /**
     * Return the database configuration for a given tenant.
     * Extend this method to support dynamic per-tenant database routing.
     */
    public function resolveDatabaseConfig(string|int $tenantId): array
    {
        return [
            'driver' => 'mysql',
            'host' => config('database.connections.mysql.host'),
            'port' => config('database.connections.mysql.port'),
            'database' => config('database.connections.mysql.database'),
            'username' => config('database.connections.mysql.username'),
            'password' => config('database.connections.mysql.password'),
        ];
    }
}
