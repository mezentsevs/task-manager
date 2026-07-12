<?php

namespace App\Models;

use App\Enums\Role as RoleEnum;
use App\Models\Role as RoleModel;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    protected $appends = ['roles'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function rolesRelation(): BelongsToMany
    {
        return $this->belongsToMany(RoleModel::class);
    }

    public function getRolesAttribute(): array
    {
        return $this->rolesRelation()->pluck('name')->toArray();
    }

    public function hasRole(RoleEnum $role): bool
    {
        return in_array($role->value, $this->roles, true);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
