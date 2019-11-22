<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ova extends Model
{
    protected $table = 'ovas';

    protected $fillable = [
        'code',
        'period',
        'theme',
        'grade_id',
        'class_id',
        'mandatory_area_id',
        'subject_id',
        'user_id',
        'image'
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function class()
    {
        return $this->belongsTo(SchoolClass::class,'class_id');
    }

    public function mandatoryArea()
    {
        return $this->belongsTo(MandatoryArea::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function learningSections()
    {
        return $this->hasMany(LearningSection::class);
    }

    public function components()
    {
        return $this->mandatoryArea->components();
    }
}
