<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    use HasFactory;
    public function posts()
    {
        return $this->hasMany(Post::class,'category');
    }
    public function childrenCategories()
    {
        return $this->hasMany(Category::class)->with('categories');
    }
    public function categories()
    {
        return $this->hasMany(Category::class,'category_id');
    }
    public function childItSelf(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'creator');
    }


}
