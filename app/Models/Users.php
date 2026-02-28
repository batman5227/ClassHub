<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Users extends Model
{
    use HasUuids;

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'password',
        'email',
        'status',
    ];

    /**
     * Get the role users for this user.
     */
    public function roleUsers(): HasMany
    {
        return $this->hasMany(RoleUsers::class, 'idUsers');
    }
}
