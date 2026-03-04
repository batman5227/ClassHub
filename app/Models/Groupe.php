<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Groupe extends Model
{
    use HasUuids;

    protected $fillable = [
        'nom',
        'idClasse',
    ];


    /**
     * Get the classe that owns the groupe.
     */
    public function classe(): BelongsTo
    {
        return $this->belongsTo(Classe::class, 'idClasse');
    }

    /**
     * Get the cours for this groupe.
     */
    public function cours(): HasMany
    {
        return $this->hasMany(Cours::class, 'idGroupe');
    }

    /**
     * Get the notifications for this groupe.
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'idGroupe');
    }

    /**
     * Get the classe matiere groupes for this groupe.
     */
    public function classeMatiereGroupes(): HasMany
    {
        return $this->hasMany(ClasseMatiereGroupe::class, 'idGroupe');
    }
    public function classeGroupe()
{
    return $this->belongsTo(Classe::class, 'idClasse');
}
}

