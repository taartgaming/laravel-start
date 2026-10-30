<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Moveset extends Model
{
    protected $fillable = [
        'name',
        'num_moves',
        'description',
        'algorithm',
        'method_id',
    ];

    public function method(): BelongsTo
    {
        return $this->belongsTo(Method::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
