<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Moveset extends Model
{
    protected $fillable = ['num_moves', 'description', 'algorithm', 'image'];

    public function methods(): HasMany
    {
        return $this->hasMany(Method::class);
    }


}
