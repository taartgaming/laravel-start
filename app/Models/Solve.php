<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solve extends Model
{
    protected $fillable = [
        'user_id',
        'scramble',
        'time_ms',
    ];

}
