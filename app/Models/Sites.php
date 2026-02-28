<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sites extends Model
{
    use HasUuids;

    protected $fillable = [
        'nom',
        'localisation',
        'idCoursDappuie',
    ];

    /**
     * Get the cours d'appui that owns the site.
     */
    public function coursdappuie(): BelongsTo
    {
        return $this->belongsTo(Coursdappuie::class, 'idCoursDappuie');
    }

    /**
     * Get the classes for this site.
     */
    public function classes(): HasMany
    {
        return $this->hasMany(Classe::class, 'idSites');
    }
}
