<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasUuids;
    protected $fillable = [
    'nom',
    'idClasse',

    ];
    public function classe()
{
    return $this->belongsTo(Classe::class, 'idClasse');
}
}
