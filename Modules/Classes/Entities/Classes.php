<?php

namespace Modules\Classes\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\School\Entities\School;

class Classes extends Model
{
    protected $fillable = [
        'name', 'school_id'
    ];
    public function classSchool()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }
}
