<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $guarded=[];
    public function categoryList(){
       return $this->belongsTo(Category::class,'category_id','id');
    }
    public function postAuthor(){
        return $this->belongsTo(User::class,'author','id');
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
