<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function post()
    {
        return $this->belongsTo(Post::class , 'post_id' , 'id');
    }

    public function comment_by()
    {
        return $this->belongsTo(User::class , 'comment_by' , 'id');
    }
}
