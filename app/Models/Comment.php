<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments'; // tên bảng SQL

    protected $fillable = [
        'comment',
        'user_id',
        'post_id',
    ];

    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
