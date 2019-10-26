<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LearningSection extends Model
{
    protected $table = 'learning_sections';
    protected $fillable = ['title','start_date','end_date','context','ova_id'];

    public function ova()
    {
        return $this->belongsTo(Ova::class);
    }

    public function components()
    {
        return $this->belongsToMany(Component::class)->withTimestamps();
    }

    public function competences()
    {
        return $this->belongsToMany(Competence::class)->withTimestamps();
    }

    public function indicators()
    {
        return $this->belongsToMany(Indicator::class)->withTimestamps();
    }
}
