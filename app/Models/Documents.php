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
    ];

    /**
     * Get the matiere that owns the document.
     */
    public function matiere(): BelongsTo
    {
        return $this->belongsTo(Matiere::class, 'idMatiere');
    }
}
