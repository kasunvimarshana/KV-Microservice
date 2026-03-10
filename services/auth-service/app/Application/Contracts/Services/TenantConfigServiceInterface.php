<?php

declare(strict_types=1);

namespace App\Application\Contracts\Services;

/**
 * Tenant Config Service Interface
 * 
 * Defines the contract for resolving tenant-specific configuration at runtime.
 */
interface TenantConfigServiceInterface
{
    public function getTenantId(): string|int|null;
    public function getTenantName(): ?string;
    public function resolveDatabaseConfig(string|int $tenantId): array;
}
