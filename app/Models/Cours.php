<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cours extends Model
{
    use HasUuids;

    protected $fillable = [
        'nom',
        'idMatiere',
        'idGroupe',
    ];

    /**
     * Get the matiere that owns the cours.
     */
    public function matiere(): BelongsTo
    {
        return $this->belongsTo(Matiere::class, 'idMatiere');
    }

    /**
     * Get the groupe that owns the cours.
     */
    public function groupe(): BelongsTo
    {
        return $this->belongsTo(Groupe::class, 'idGroupe');
    }
}
