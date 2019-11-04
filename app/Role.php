<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['name'];
    protected $hidden = ['created_at','updated_at'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Get the current model permissions
     *
     * @param int $id
     * @return void
     */
    public function existentPermission($id)
    {
        foreach ($this->permissions->pluck('id') as $idPermission) {
            if ($idPermission ===  $id) {
                return true;
            }
        }
    }
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
