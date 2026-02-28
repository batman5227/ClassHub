<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasUuids;

    protected $fillable = [
        'titre',
        'message',
        'idGroupe',
    ];

    /**
     * Get the groupe that owns the notification.
     */
    public function groupe(): BelongsTo
    {
        return $this->belongsTo(Groupe::class, 'idGroupe');
    }
}
