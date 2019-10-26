<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $table = 'components';
    protected $fillable = ['name','mandatory_area_id'];

    public function mandatoryArea()
    {
        return $this->belongsTo(MandatoryArea::class);
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class)->withTimestamps();
    }

    public function competences()
    {
        return $this->hasMany(Competence::class);
    }

    public function learningSections()
    {
        return $this->belongsToMany(LearningSection::class);
    }
}
