<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Solve extends Model
{
    protected $fillable = [
        'user_id',
        'scramble',
        'time_ms',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
