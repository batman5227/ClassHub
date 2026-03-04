<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class eleves extends Model
{
    use HasUuids;

    protected $fillable = [
        'nom',
        'prenom',
        'numParents',
    ];

    /**
     * Get the route key name for route model binding.
     */
    public function getRouteKeyName(): string
    {
        return 'id';
    }
}
