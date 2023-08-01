<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Nicolaslopezj\Searchable\SearchableTrait;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SearchableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $searchable = [
        'columns' => [
            'name' => 10,
            'email' => 9,
            'nohp' => 8,
        ],
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'foto',
        'akses',
        'nohp',
        'nohp_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeClient($q)
    {
        return $q->where('akses', 'client');
    }

    /**
     * Get all of the member for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function member(): HasMany
    {
        return $this->hasMany(Member::class, 'client_id', 'id');
    }

    public function getAllMemberId(): array
    {
        return $this->member()->pluck('id')->toArray();
    }

    public function getNameWithNohpAttribute() 
    {
        return $this->name . ' (' . formatNomorHp($this->nohp) . ')';
    }
}
