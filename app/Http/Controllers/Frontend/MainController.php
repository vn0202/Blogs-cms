<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Builder;
use function Sodium\library_version_minor;

class MainController extends Controller
{
    //

    public function index(Request $request)
    {
//   dd('nghia');

            $posts = Post::paginate(10)->appends($request->all());


        $category = '';
//        $rest = false;
//        if(Post::count() > 5)
//        {
//            $rest= true;
//        }
        return view('frontend.index', compact('posts','category'));
    }

    public function list_post_by_category(Request $request,string $slug_cat)
    {
        $cate= Category::where('slug',$slug_cat)->first();
        $title = $cate->title;
        $category = $cate->id;
        $posts = Post::whereHas('categories', function (Builder $query) use ($slug_cat) {
            $query->where('slug', $slug_cat);
        })->paginate(10)->appends($request->all());


   return view('frontend.post_by_category',compact('title','posts','category'));
    }
    public function list_post_by_tag(Request $request, string $slug)
    {
        $category = "";
        $tag = $slug;
        $title = " Bai viet lien quan: ";
        $posts = Post::whereHas('tags',function (Builder $query) use ($slug){
            $query->where('slug',$slug);
        })->paginate(10)->appends($request->all());
        return view('frontend.post_by_tag',compact('title','category','posts','tag'));
    }
  public function search(Request $request)
  {

      $category = '';
      $search = $request->search ?? "";
      if($search)
      {
          $posts = Post::where('title','like',"%$search%")->paginate(10)->appends($request->all());
      }
      else{
          $posts = Post::paginate(10)->appends($request->all());
      }
      return view('frontend.result_search',compact('posts','category'));
  }
  public function detail(string $category,string $slug)
  {
      $post = Post::where('slug',$slug)->first();
      $post->views++;
      $post->save();
      $relative_posts = Post::whereHas('categories',function (Builder $query) use ($category){
          $query->where('slug',$category);
      })->get();
      return view('frontend.detail',compact('post','relative_posts'));
  }

}
