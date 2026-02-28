<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasUuids;

    protected $fillable = [
        'nom',
    ];

    /**
     * Get the role users for this role.
     */
    public function roleUsers(): HasMany
    {
        return $this->hasMany(RoleUsers::class, 'idRole');
    }
}
