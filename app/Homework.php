<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    protected $table = 'homeworks';
    protected $fillable = ['link','content','presentation','learning_section_id'];

    public function learningSection()
    {
        return $this->belongsTo(LearningSection::class);
    }
}
