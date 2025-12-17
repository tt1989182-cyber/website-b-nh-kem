<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts'; // tên bảng SQL

    protected $fillable = [
        'caption',
        'image_path',
        'image_url',
        'user_id',
    ];

    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với Comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Quan hệ với Like
    public function likes()
    {
        return $this->hasMany(Like::class);
    }



}
