<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $table = 'classes';
    protected $fillable = ['name','grade_id'];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
