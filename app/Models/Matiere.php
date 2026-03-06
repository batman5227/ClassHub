<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Matiere extends Model
{
    use HasUuids;

    protected $fillable = [
        'nom',
        'idClasse'
    ];

    public function cours()
    {
        return $this->hasMany(Cours::class,'idMatiere');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class,'idClasse');
    }
};