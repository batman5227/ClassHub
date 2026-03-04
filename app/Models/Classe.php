<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classe extends Model
{
    use HasUuids;

    protected $fillable = [
        'nom',
        'idSites',
    ];


    /**
     * Get the site that owns the classe.
     */
    public function sites(): BelongsTo
    {
        return $this->belongsTo(Sites::class, 'idSites');
    }

    /**
     * Get the classe matiere groupes for this classe.
     */
    public function classeMatiereGroupes(): HasMany
    {
        return $this->hasMany(ClasseMatiereGroupe::class, 'idClasse');
    }
    public function site()
{
    return $this->belongsTo(Sites::class, 'idSites');
}

public function groupes()
{
    return $this->hasMany(Groupe::class, 'idClasse');
}
}
