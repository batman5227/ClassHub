<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClasseMatiereGroupe extends Model
{
    use HasUuids;

    protected $fillable = [
        'idMatiere',
        'idClasse',
        'idGroupe',
    ];

    /**
     * Get the matiere that owns the classe matiere groupe.
     */
    public function matiere(): BelongsTo
    {
        return $this->belongsTo(Matiere::class, 'idMatiere');
    }

    /**
     * Get the classe that owns the classe matiere groupe.
     */
    public function classe(): BelongsTo
    {
        return $this->belongsTo(Classe::class, 'idClasse');
    }

    /**
     * Get the groupe that owns the classe matiere groupe.
     */
    public function groupe(): BelongsTo
    {
        return $this->belongsTo(Groupe::class, 'idGroupe');
    }
}
