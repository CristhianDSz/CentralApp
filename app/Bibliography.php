<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bibliography extends Model
{
    protected $table = 'bibliographies';
    protected $fillable = ['url','learning_section_id'];

    public function learningSection()
    {
        return $this->belongsTo(LearningSection::class);        
    }
}
