<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'view',
        'add',
        'edit',
        'delete',
    ];
}
