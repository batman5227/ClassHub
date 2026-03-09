<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Documents extends Model
{
    use HasUuids;

    protected $fillable = [
        'nom',
        'idMatiere',
        'fichier',
    ];

    /**
     * Get the matiere that owns the document.
     */
    public function matieres(): BelongsTo
    {
        return $this->belongsTo(Matiere::class, 'idMatiere');
    }
    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'classe_document', 'document_id', 'classe_id');
    }
}
