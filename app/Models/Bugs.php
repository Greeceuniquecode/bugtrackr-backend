<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bugs extends Model
{
    protected $fillable = [
        'title',
        'description',
        'code',
        'status',
        'project_id',
        'user_id',
    ];
}
