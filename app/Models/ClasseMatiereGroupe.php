<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ClasseMatiereGroupe extends Model
{
    use HasUuids;
    protected $fillable = [
    'idMatiere',
    'idClasse',
    'idGroupe',

    ];
}
