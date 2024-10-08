<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

