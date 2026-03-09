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
    'idAnneeScolaire'

    ];

    public function site()
{
    return $this->belongsTo(Sites::class, 'idSites');
}
public function eleves(){
    return $this->hasMany(eleves::class, 'idClasse');
}

public function groupes()
{
    return $this->hasMany(Groupe::class, 'idClasse');
}
public function anneeScolaire()
{
    return $this->belongsTo(AnneeScolaire::class, 'idAnneeScolaire');
}
}
