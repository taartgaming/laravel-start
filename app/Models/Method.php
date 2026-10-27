<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Method extends Model
{
    public function movesets(): HasMany
    {
        return $this->hasMany(Moveset::class);
    }
}
