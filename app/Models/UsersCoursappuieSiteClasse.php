<?php

namespace App\Models;

use App\Models\Classe;
use App\Models\Sites;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UsersCoursappuieSiteClasse extends Model
{
    //
    protected $fillable = [
        'userId',
        'coursAppuieId',
        'siteId',
        'classeId',
    ];


      public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'userId', 'id');
    }

    /**
     * Relation avec la classe
     */
    public function classe(): BelongsTo
    {
        return $this->belongsTo(Classe::class, 'classeId', 'id');
    }

    /**
     * Relation avec le site
     */
    public function site(): BelongsTo
    {
        return $this->belongsTo(Sites::class, 'siteId', 'id');
    }

    /**
     * Relation avec le cours d'appui
     */
    public function coursAppuie(): BelongsTo
    {
        return $this->belongsTo(Coursdappuie::class, 'coursAppuieId', 'id');
    }
}
