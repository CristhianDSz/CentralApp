<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $fillable = ['name','description'];
    protected $hidden = ['created_at','updated_at'];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
