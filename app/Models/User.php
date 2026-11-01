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
        return in_array($this->role, ['admin', 'creator'], true);
    }

    public function tryCreator(): void
    {
        if ($this->role === 'admin') {
            return;
        }

        $wasCreator = $this->role === 'creator';
        $this->role = $this->solves()->where('accepted', true)->count() > 5
            ? 'creator'
            : 'user';
        $this->save();

        if ($wasCreator && $this->role === 'user') {
            $this->movesets()->update(['is_active' => false]);
        }
    }


    public function solves(): HasMany
    {
        return $this->hasMany(Solve::class);
    }

    public function movesets(): HasMany
    {
        return $this->hasMany(Moveset::class);
    }
}
