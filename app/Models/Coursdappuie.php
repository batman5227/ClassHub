<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coursdappuie extends Model
{
    use HasUuids;

    protected $fillable = [
        'nom',
    ];

    /**
     * Get the sites for this cours d'appui.
     */
    public function sites(): HasMany
    {
        return $this->hasMany(Sites::class, 'idCoursDappuie');
    }
}
