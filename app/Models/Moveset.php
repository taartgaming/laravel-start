<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Moveset extends Model
{
    protected $fillable = ['num_moves', 'description', 'algorithm',];

    public function method(): BelongsTo
    {
        return $this->belongsTo(Method::class);
    }


}
