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

    public function list_post_by_category(Request $request,string $slug_cat)
    {
        $cate= Category::where('slug',$slug_cat)->firstOrFail();
        $title = $cate->title;
        $category = $cate->id;
        $posts = Post::whereHas('categories', function (Builder $query) use ($slug_cat) {
            $query->where('slug', $slug_cat);
        })->where('active','1')->paginate(10)->appends($request->all());


   return view('frontend.post_by_category',compact('title','posts','category'));
    }
    public function list_post_by_tag(Request $request, string $slug)
    {
        $category = "";
        $tag = $slug;
        $title = " Bai viet lien quan: ";
        $posts = Post::whereHas('tags',function (Builder $query) use ($slug){
            $query->where('slug',$slug);
        })->where('active','1')->paginate(10)->appends($request->all());
        return view('frontend.post_by_tag',compact('title','category','posts','tag'));
    }
  public function search(Request $request)
  {

      $category = '';
      $search = $request->search ?? "";
      if($search)
      {
          $posts = Post::where('title','like',"%$search%")->where('active','1')->paginate(10)->appends($request->all());
      }
      else{
          $posts = Post::where('active','1')->paginate(10)->appends($request->all());
      }
      return view('frontend.result_search',compact('posts','category'));
  }
  public function detail(string $category,string $slug)
  {
      $post = Post::where('slug',$slug)->firstOrFail();
      $post->views++;
      $post->save();
      $relative_posts = Post::whereHas('categories',function (Builder $query) use ($category){
          $query->where('slug',$category);
      })->get();
      return view('frontend.detail',compact('post','relative_posts'));
  }
public function getMorePosts(Request $request)
{
    if($request->ajax()){
        $posts = Post::where('active','1')->paginate(10);
        return view('frontend.inc.list_post',compact('posts'))->render();
    }

}

}
