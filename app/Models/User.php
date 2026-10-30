<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canCreateMovesets(): bool
    {
        if ($this->role !== 'admin' || $this->role !== 'creator') {
            $solveCount = Solve::where('user_id', '=', auth()->user()->id)->count();
            $solver = auth()->user();

            if ($solveCount >= 5) {
                $solver->role = 'creator';

            }
        }
        return $this->role === 'admin' || $this->role === 'creator';
    }


    public function solves(): HasMany
    {
        return $this->hasMany(Solve::class);
    }
}
