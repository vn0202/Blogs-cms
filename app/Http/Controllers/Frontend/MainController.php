<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use DebugBar\DebugBar;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Builder;
use function Sodium\library_version_minor;

class MainController extends Controller
{
    //

    public function index(Request $request)
    {

            $posts = Post::where('active','1')->paginate(10)->withQueryString();

        $category = '';

        return view('frontend.index', compact('posts','category'));
    }




  public function show(string $category,string $slug)
  {
      $post = Post::where('slug',$slug)->firstOrFail();
      $post->views++;
      $post->save();
      //list relative posts
      $posts = Post::whereHas('categories',function (Builder $query) use ($category){
          $query->where('slug',$category);
      })->paginate(10)->withQueryString();
      return view('frontend.detail',compact('post','posts'));
  }


}
