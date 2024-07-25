<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'user_name',
        'password',
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

    /** 
     * get all the posts of the user 
    */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * get all forms of the user 
     */
    public function forms(): HasMany
    {
        return $this->hasMany(Form::class);
    }

    /**
     * get all visits of the user
     */
    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }
    /**
     * get all receptions of the user
     */
    public function receptions(): HasMany
    {
        return $this->hasMany(Reception::class);
    }
    /**
     * get all medias of the user
     */
    public function medias(): HasMany
    {
        return $this->hasMany(Media::class);
    }
    
}
