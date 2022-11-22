<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
  public function  user()
  {
      return $this->belongsTo(User::class,'author');
  }
  public function tags()
  {
      return $this->belongsToMany(Tag::class,'post_tags');
  }
public function categories()
{
    return $this->belongsTo(Category::class,'category');
}



}
