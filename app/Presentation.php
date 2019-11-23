<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
    protected $table = 'presentations';
    protected $fillable = ['name'];

    public function homeworks()
    {
        return $this->hasMany(Homework::class);
    }
}
