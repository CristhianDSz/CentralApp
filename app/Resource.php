<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table = 'resources';
    protected $fillable = ['url','learning_section_id'];
    
    public function learningSection()
    {
        return $this->belongsTo(LearningSection::class);
    }


}
