<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Application\Contracts\Repositories\UserRepositoryInterface;
use App\Domain\Models\User;
use Illuminate\Database\Eloquent\Model;
use Shared\BaseRepository\BaseRepository;

/**
 * Eloquent User Repository
 * 
 * Concrete implementation of UserRepositoryInterface using Eloquent ORM.
 * Extends BaseRepository for all standard CRUD + pagination operations.
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected array $searchableColumns = ['name', 'email'];
    protected array $sortableColumns = ['id', 'name', 'email', 'created_at', 'updated_at'];
    protected array $filterableColumns = ['status', 'tenant_id', 'role'];

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Find a user by their email address.
     */
    public function findByEmail(string $email): ?Model
    {
        return $this->findBy('email', $email);
    }

    /**
     * Find a user by their UUID.
     */
    public function findByUuid(string $uuid): ?Model
    {
        return $this->findBy('uuid', $uuid);
    }

    /**
     * Check if a user exists with the given email.
     */
    public function existsByEmail(string $email): bool
    {
        return $this->exists(['email' => $email]);
    }
}
