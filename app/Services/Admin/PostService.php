<?php

namespace App\Services\Admin;

use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostTags;
use App\Models\Tag;
use http\Env\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostService
{

    public $post;

    public static function store(PostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->category = $request->category;
        $post->description = $request->description;
        $post->slug = Str::of($request->title)->slug('-');
        $post->content = $request->input('content');
        $post->author = Auth::user()->id;
        //handle if has choosen thumb
        if ($request->hasFile('thumb')) {
            $name = $request->file('thumb')->getClientOriginalName();
            $path = $request->thumb->storeAs('public/posts', $name);
            $post->thumb = 'storage/posts/' . $name;
        }
        $post->active = $request->status;
        $post->save();

      self::saveTag($request, $post->id);

    }

    public static  function save(UpdatePostRequest $request, int $post_id)
    {
        $post = Post::find($post_id);
        $post->title = $request->title;
        $post->category = $request->category;
        $post->description = $request->description;
        $post->slug = Str::of($request->title)->slug('-');
        $post->content = $request->input('content');
        $post->author = Auth::user()->id;
        //handle if has choosen thumb
        if ($request->hasFile('thumb')) {
            $name = $request->file('thumb')->getClientOriginalName();
            $path = $request->thumb->storeAs('public/posts', $name);
            $post->thumb = 'storage/posts/' . $name;
        }
        $post->active = $request->status;
        $post->save();
        self::saveChangeTags($request,$post_id);
    }

    public static function saveTag(PostRequest $request, int $post_id)
    {
        if (!empty($request->tagcheck)) {
            foreach ($request->tagcheck as $tag) {
                $post_tag = new PostTags();
                $post_tag->post_id = $post_id;
                $post_tag->tag_id = $tag;
                $post_tag->save();
            }
        }
    }

    public static function saveChangeTags(UpdatePostRequest $request, int $post_id)
    {

        // check and handle these tags that was removed and that have just add
        // list tags that have chosen before
        $list_old_tags = PostTags::where('post_id', $post_id)->pluck('id')->toArray();
        //list tags that have justs add
        $list_edit_tags = $request->tagcheck;
        if ($list_edit_tags) {
            $list_delete_tag = array_diff($list_old_tags, $list_edit_tags);
            $list_add_tag = array_diff($list_edit_tags, $list_old_tags);
            //delete
            foreach ($list_delete_tag as $tag) {
                PostTags::where('post_id', $post_id)->where('tag_id', (int)$tag)->delete();
            }
            //add
            foreach ($list_add_tag as $tag) {
                $postTag = new PostTags();
                $postTag->post_id = $post_id;
                $postTag->tag_id = (int)$tag;
                $postTag->save();
            }
        }
    }

    public static  function search(Request $request)
    {
            $posts = Post::with(['categories', 'user'])->where('title', 'like', "%$request->search%")->paginate(10)
                ->withQueryString();
             return $posts;
    }
    public static  function filter(\Illuminate\Http\Request $request)
    {
        $filter_by_cat = $request->category_id ?? "";
        $filter_by_tag = $request->tag_id ?? "";
        //hanle if filter by tag is not
        if (!empty($filter_by_cat) && empty($filter_by_tag)) {
            $posts = Post::with(['categories', 'user'])->where('category', $filter_by_cat)
                ->paginate(10)->withQueryString();
        } //hanle if filter by cat is not
        elseif (!empty($filter_by_tag) && empty($filter_by_cat)) {
            $posts = Post::with(['tags', 'user'])->whereHas('tags', function (Builder $query) use ($filter_by_tag) {
                $query->where('tag_id', $filter_by_tag);
            })->paginate(10)->withQueryString();
        } //hanle if filter by both tag and cat
        elseif (!empty($filter_by_tag) && !empty($filter_by_cat)) {
            $posts = Post::with(['tags', 'user'])->whereHas('tags', function (Builder $query) use ($filter_by_tag) {
                $query->where('tag_id', $filter_by_tag);
            })
                ->where('category', $filter_by_cat)->paginate(10)->withQueryString();

        } else {
            $posts = Post::with(['categories', 'user'])->paginate(10)->withQueryString();
            $isFilter = false;
        }
        return $posts;
    }
    public function getDataFilter()
    {
        $type = $_GET['type'] ?? '';
        $search = $_GET['search'] ?? "";
        if ($type == 1) {
            $list_cat = Category::where('title', 'like', "%$search%")->get();
            return json_encode($list_cat);
        } else {
            $list_tags = Tag::where('name', 'like', "%$search%")->get();
            return json_encode($list_tags);
        }

    }

    public function getMorePosts(\Illuminate\Http\Request $request)
    {
        if ($request->ajax()) {
            $posts = Post::with(['categories', 'user'])->paginate(10);
            return view('admin.inc.post_data', compact('posts'))->render();
        }

    }

}
