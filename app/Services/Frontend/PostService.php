<?php

namespace App\Frontend;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PostService{
    public function list_post_by_category(Request $request,string $slug_cat)
    {
        if(!$request->ajax()) {

            $cate = Category::where('slug', $slug_cat)->firstOrFail();
            $title = $cate->title;
            $category = $cate->id;
            $posts = Post::whereHas('categories', function (Builder $query) use ($slug_cat) {
                $query->where('slug', $slug_cat);
            })->where('active', '1')->paginate(10)->withQueryString();
            return view('frontend.post_by_category',compact('title','posts','category'));

        }
        else{
            $posts = Post::whereHas('categories', function (Builder $query) use ($slug_cat) {
                $query->where('slug', $slug_cat);
            })->where('active', '1')->paginate(10)->withQueryString();
            return view('frontend.inc.list_post',compact('posts'))->render();
        }

    }
    public function list_post_by_tag(Request $request, string $slug_tag)
    {
        if(!$request->ajax()) {
            $category = "";
            $tag = $slug_tag;
            $title = " Bai viet lien quan: ";
            $posts = Post::whereHas('tags', function (Builder $query) use ($slug_tag) {
                $query->where('slug', $slug_tag);
            })->where('active', '1')->paginate(10)->appends($request->all());
            return view('frontend.post_by_tag', compact('title', 'category', 'posts', 'tag'));
        }
        else{
            $posts = Post::whereHas('tags', function (Builder $query) use ($slug_tag) {
                $query->where('slug', $slug_tag);
            })->where('active', '1')->paginate(10)->withQueryString();
            return view('frontend.inc.list_post',compact('posts'))->render();
        }
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
    public function getMorePosts(Request $request)
    {
        if($request->ajax()){
            $posts = Post::where('active','1')->paginate(10);
            return view('frontend.inc.list_post',compact('posts'))->render();
        }

    }
    public function handleClickSeeMore()
    {

        // handle click to render next 5 files
        $last_number = $_GET['last_number'] ?? 0;
        $last_number = (int)$last_number;
        $category = $_GET['category'] ?? 0;
        if ($last_number) {
            if (!$category) {
                $posts = Post::where('active',1)->limit(5)->offset($last_number)->get();
            } else {
                $posts = Post::where('active',1)->where('category',$category)->limit(5)->offset($last_number)->get();
            }
            foreach ($posts as &$post) {
                $post->author = $post->user;
                $post->category = $post->categories;
            }
            return json_encode($posts);
        }
    }
}
