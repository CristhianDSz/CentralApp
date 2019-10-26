<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    protected $table = 'indicators';
    protected $fillable = ['name','competence_id'];

    public function competence()
    {
        return $this->belongsTo(Competence::class);
    }
}
