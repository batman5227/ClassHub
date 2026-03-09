<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersCoursDappuieSitesClasse extends Model
{
    //
    protected $fillable=[
        'idUsers',
        'idCoursDappuie',
        'idSites',
        'idClasse',
    ];
    public function users(){
        return $this->belongsTo(Users::class,'idUsers');
    }
    public function coursDappuie(){
        return $this->belongsTo(Coursdappuie::class,'idCoursDappuie');
    }
    public function sites(){
        return $this->belongsTo(Sites::class,'idSites');
}
public function classe(){
    return $this->belongsTo(Classe::class,'idClasse');
}
}
