<?php

namespace App\Models;
use App\Models\permissions;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasUuids;
    protected $fillable = [
    'nom',
    'description',

    ];
    public function permissions()
    {
        return $this->belongsToMany(permissions::class, 'rolespermissions', 'roleId', 'permissionId');
    }
    // Ajoute cette méthode (si elle n'existe pas déjà)
public function users()
{
    return $this->belongsToMany(Users::class, 'role_users', 'idRole', 'idUsers')
                ->withTimestamps();
}

}
