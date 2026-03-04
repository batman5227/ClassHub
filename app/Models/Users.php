<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Users extends Model
class Users extends Authenticatable
{
    use HasUuids;

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'password',
        'email',
        'photo',
        'status',
    ];

    /**
     * Get the role users for this user.
     */
    public function roleUsers(): HasMany
    {
        return $this->hasMany(RoleUsers::class, 'idUsers');
    }
    // Ajoute cette méthode
public function roles()
{
    return $this->belongsToMany(Role::class, 'role_users', 'idUsers', 'idRole')
                ->withTimestamps();
}
public function coursAppuieAffectations()
{
    return $this->hasMany(UsersCoursappuieSiteClasse::class, 'userId', 'id');
}
}
