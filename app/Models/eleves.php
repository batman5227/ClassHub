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
        'idClasse',
    ];

    /**
     * Get the classe that owns the eleve.
     */
    public function classe(): BelongsTo
    {
        return $this->belongsTo(Classe::class, 'idClasse');
    }
}
