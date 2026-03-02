<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoleUsers extends Model
{
    use HasUuids;
    protected $fillable = [
    'idRole',
    'idUsers',

    ];
      public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'idUsers', 'id');
    }

    /**
     * Relation avec le rôle
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'idRole', 'id');
    }
}
