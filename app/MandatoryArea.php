<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MandatoryArea extends Model
{
    protected $table = 'mandatory_areas';
    protected $fillable = ['name'];

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function components()
    {
        return $this->hasMany(Component::class);
    }
}
