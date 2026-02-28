<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoleUsers extends Model
{
    use HasUuids;

    protected $table = 'role_users';

    protected $fillable = [
        'idRole',
        'idUsers',
    ];

    /**
     * Get the role that owns the role user.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'idRole');
    }

    /**
     * Get the user that owns the role user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'idUsers');
    }
}
