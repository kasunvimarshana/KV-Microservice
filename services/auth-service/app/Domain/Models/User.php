<?php

declare(strict_types=1);

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Shared\Traits\HasAuditLog;
use Shared\Traits\HasTenantScope;
use Shared\Traits\HasUuid;

/**
 * User Domain Model
 * 
 * Core user entity for the Auth Service.
 * Combines Passport token support with multi-tenancy and audit logging.
 *
 * @property string      $id
 * @property string      $name
 * @property string      $email
 * @property string      $password
 * @property string|null $tenant_id
 * @property string|null $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasUuid, HasTenantScope, HasAuditLog, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'tenant_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
