<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    protected $table = 'homeworks';
    protected $fillable = ['link','content','presentation_id','learning_section_id'];

    public function learningSection()
    {
        return $this->belongsTo(LearningSection::class);
    }

    public function presentation()
    {
        return $this->belongsTo(Presentation::class);
    }
}
