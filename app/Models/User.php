<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'profile_image',
        'bio',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Quan hệ với Post
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    // Quan hệ với Like
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    // Quan hệ với Comment
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
