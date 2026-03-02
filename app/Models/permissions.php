<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class permissions extends Model
{
    //
    // ✅ Pour les UUIDs
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['nom', 'description'];
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'rolespermissions', 'permissionId', 'roleId');
    }
}
