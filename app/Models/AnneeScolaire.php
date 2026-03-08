<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnneeScolaire extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'annee_scolaires';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'annee',
        'date_debut',
        'date_fin',
        'is_active'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'is_active' => 'boolean'
    ];

    public function classes()
    {
        return $this->hasMany(Classe::class, 'idAnneeScolaire');
    }

    public function eleveClasseAnnees()
    {
        return $this->hasMany(eleves::class, 'idAnneeScolaire');
    }
}
