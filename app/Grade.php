<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'grades';
    protected $fillable = ['name'];

    public function classes()
    {
        return $this->hasMany(SchoolClass::class,'grade_id');
    }
}
