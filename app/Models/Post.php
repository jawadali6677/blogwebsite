<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'tags' => 'array'
    ];

    public function category(){
        
        return $this->belongsTo(Category::class , 'category_id' , 'id');
    }

    public function author(){
        
        return $this->belongsTo(User::class , 'post_by' , 'id');
    }

    public function comments(){
        
        return $this->hasMany(Comment::class , 'post_id' , 'id');
    }

    public function like()
    {
        return $this->hasOne(PostLike::class, "post_id" , "id")->when(auth()->check(), function($query){
            $query->where("like_by" , Auth::user()->id);
        });
    }

    public function likes()
    {
        return $this->hasOne(PostLike::class, "post_id" , "id");
    }
}

