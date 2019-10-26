<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    protected $table = 'competences';
    protected $fillable = ['name','component_id'];

    public function component()
    {
        return $this->belongsTo(Component::class);
    }

    public function indicators()
    {
        return $this->hasMany(Indicator::class);
    }
}
