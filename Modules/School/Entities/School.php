<?php

namespace Modules\School\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Classes\Entities\Classes;

class School extends Model
{
    protected $fillable = [
        'name', 'address'
    ];
    public function schoolClass()
    {
        return $this->hasMany( Classes::class);
    }
}
