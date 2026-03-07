<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class eleves extends Model
{
    use HasUuids;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'numParent',
        'idClasse',
        'idSites',
        'idCoursDappuie',
    ];

    /**
     * Get the route key name for route model binding.
     */
    public function getRouteKeyName(): string
    {
        return 'id';
    }

    /**
     * Get the classe that owns the eleve.
     */
    public function classe(): BelongsTo
    {
        return $this->belongsTo(Classe::class, 'idClasse');
    }

    /**
     * Get the site that owns the eleve.
     */
    public function sites(): BelongsTo
    {
        return $this->belongsTo(Sites::class, 'idSites');
    }

    /**
     * Get the cours d'appuie that owns the eleve.
     */
    public function coursdappuie(): BelongsTo
    {
        return $this->belongsTo(Coursdappuie::class, 'idCoursDappuie');
    }
}
