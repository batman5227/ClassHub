<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasUuids;
    protected $fillable = [
    'nom',
    'idSites',

    ];

    public function site()
{
    return $this->belongsTo(Sites::class, 'idSites');
}

public function groupes()
{
    return $this->hasMany(Groupe::class, 'idClasse');
}
}
