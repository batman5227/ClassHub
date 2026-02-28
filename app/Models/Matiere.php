<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Matiere extends Model
{
    use HasUuids;

    protected $fillable = [
        'nom',
    ];

    /**
     * Get the cours for this matiere.
     */
    public function cours(): HasMany
    {
        return $this->hasMany(Cours::class, 'idMatiere');
    }

    /**
     * Get the documents for this matiere.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Documents::class, 'idMatiere');
    }

    /**
     * Get the classe matiere groupes for this matiere.
     */
    public function classeMatiereGroupes(): HasMany
    {
        return $this->hasMany(ClasseMatiereGroupe::class, 'idMatiere');
    }
}
