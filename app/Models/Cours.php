<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Cours extends Model
{
    use HasUuids;

    protected $fillable = [
        'nom',
        'idMatiere'
    ];

    public function matiere()
    {
        return $this->belongsTo(Matiere::class,'idMatiere');
    }
};


