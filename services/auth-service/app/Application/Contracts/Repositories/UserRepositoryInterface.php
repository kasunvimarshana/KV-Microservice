<?php

declare(strict_types=1);

namespace App\Application\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * User Repository Interface
 * 
 * Defines the contract for user data persistence operations.
 * The Application layer depends on this interface, not on Eloquent directly.
 */
interface UserRepositoryInterface
{
    public function findByEmail(string $email): ?Model;
    public function findByUuid(string $uuid): ?Model;
    public function existsByEmail(string $email): bool;
}
