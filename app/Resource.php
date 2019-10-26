<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table = 'resources';
    protected $fillable = ['name','learning_section_id'];
    
    public function ova()
    {
        //return $this->belongsTo(Ova::class);
    }
}
