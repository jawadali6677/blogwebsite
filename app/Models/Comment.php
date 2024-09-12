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

    public function commentBy()
    {
        return $this->belongsTo(User::class , 'comment_by' , 'id');
    }

    public function childern()
    {
        return $this->hasMany(Comment::class , 'parent_id' , 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
