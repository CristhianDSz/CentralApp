<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $fillable = ['name','mandatory_area_id'];

    public function mandatoryArea()
    {
        return $this->belongsTo(MandatoryArea::class);
    }
}
