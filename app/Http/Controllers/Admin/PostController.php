<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostTags;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;

class PostController extends Controller
{
    //
    public function index(Request $request)
    {
        $isFilter = true;
        if(!empty($request->search))
        {
           $posts = Post::with(['categories','user'])->where('title','like',"%$request->search%")->paginate(10)
           ->withQueryString();
        }
        else{
            $filter_by_cat = $request->category_id ?? "";
            $filter_by_tag = $request->tag_id ?? "";
            //hanle if filter by tag is not
            if(!empty($filter_by_cat) && empty($filter_by_tag) ){
                $posts = Post::with(['categories','user'])->where('category',$filter_by_cat)
                    ->paginate(10)->withQueryString();
            }
            //hanle if filter by cat is not
            elseif(!empty($filter_by_tag) && empty($filter_by_cat))
            {

                $posts = Post::with(['categories','user'])->whereHas('tags',function (Builder $query) use ($filter_by_tag){
                      $query->where('tag_id',$filter_by_tag);
                })->paginate(10)->withQueryString();
            }
            //hanle if filter by both tag and cat
            elseif(!empty($filter_by_tag) && !empty($filter_by_cat))
            {
                $posts = Post::with(['categories','user'])->whereHas('tags',function (Builder $query) use ($filter_by_tag){
                    $query->where('tag_id',$filter_by_tag);
                })
                    ->where('category',$filter_by_cat)->paginate(10)->withQueryString();

            }
            else{
                $posts = Post::with(['categories','user'])->paginate(10)->withQueryString();
                $isFilter = false;
            }
        }


        $title = "Danh sách bài viết ";
        return view('admin.posts.list', compact('title', 'posts','isFilter'));
    }

    public function create()
    {
        $title = "Thêm bài viết mới ";

        $categories = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();
        $tags = Tag::all();
        return view('admin.posts.add', compact('title', 'categories', 'tags'));
    }

    public function show(int $id)
    {
        $title = "Bài viết";
        $post = Post::find($id);
        $list_tags = PostTags::with(['categories','user'])->where('post_id', $id)->get();

        return view('admin.posts.show', compact('title', 'post', 'list_tags'));


    }

    public function store(PostRequest $request)
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
        $post_id = $post->id;
        $slug = Str::of($request->tag)->slug('-');
        if (!empty($request->tagcheck)) {
            foreach ($request->tagcheck as $tag) {
                $post_tag = new PostTags();
                $post_tag->post_id = $post_id;
                $post_tag->tag_id = $tag;
                $post_tag->save();
            }

        }
        return back()->with('success', "Created!");


    }

    public function edit(int $id)
    {
        $auth_id = Auth::user()->id;
        $post = Post::find($id);
        $role = Auth::user()->role;
        if ($role == 1 || $post->author == $auth_id) {
            $title = "Chỉnh sửa bài viết";
            $categories = Category::whereNull('category_id')
                ->with('childrenCategories')
                ->get();
//            $tags = Tag::whereHas('posts',function (Builder $query) use($id){
//                 $query->where('post_id',$id);
//            })->pluck('id')->toArray();

            return view('admin.posts.edit', compact('title', 'post', 'categories'));
        }

        return back()->with('nopermission',"Ban không có quyền chỉnh sửa bài viết này");
        }

    public function handleEdit(Request $request, int $id)
    {
        $rules = [
            'title' => ['required'],
            'description' => ['required'],
            'content' => ['required'],
            'thumb' => ['nullable','image'],
        ];
        $messages = [
            'title.required' => "Bạn cần cung cấp tiêu đề bài viết",
            'description.required' => "Bạn chưa có mô tả bài viết",
            'content.requried' => "Bạn chưa có nội dung bài viết",
            'thumb.image' => "Chỉ hỗ trợ định dạng hình ảnh",
        ];
        $this->validate($request, $rules, $messages);
        $post = Post::find($id);

        $post->title = $request->title;
        $post->slug = Str::of($request->title)->slug('-');
        $post->category = $request->category;
        $post->description = $request->description;
        $post->content = $request->input('content');
        $post->active = $request->status;
        if ($request->hasFile('thumb')) {
            $name = $request->file('thumb')->getClientOriginalName();
            $path = $request->thumb->storeAs('public/posts', $name);
            $post->thumb = 'storage/posts/' . $name;
        }
        $post->save();

        // check and handle these tags that was removed and that have just add
        // list tags that have chosen before
        $list_old_tags  = PostTags::where('post_id', $id)->pluck('id')->toArray();

        //list tags that have justs add
        $list_edit_tags = $request->tagcheck;
        if($list_edit_tags) {
            $list_delete_tag = array_diff($list_old_tags, $list_edit_tags);
            $list_add_tag = array_diff($list_edit_tags, $list_old_tags);


            //delete
            foreach ($list_delete_tag as $tag) {
                PostTags::where('post_id', $id)->where('tag_id', (int)$tag)->delete();
            }
            //add
            foreach ($list_add_tag as $tag) {
                $postTag = new PostTags();
                $postTag->post_id = $id;
                $postTag->tag_id = (int)$tag;
                $postTag->save();
            }
        }
        return back()->with('success', "Updated!");
    }
    public function delete(int $id)
    {

        $auth_id = Auth::user()->id;
        $role = Auth::user()->role;
        $post = Post::find($id);
        //check permission
        if ($role == 1 || $post->author == $auth_id) {
          //check if whether post has relative to any tags
            if(PostTags::where('post_id',$id)->count())
            {
                return back()->with('failure',"Bài viết còn liên quan đến các mục khác..chưa thể xóa");

            }
          Post::destroy($id);
          return back()->with('success','Deleted!');
        }
        return back()->with('nopermission',"Ban không có quyền chỉnh sửa bài viết này");


    }
    public function filter()
    {
     $type = $_GET['type'] ?? '';
     $search = $_GET['search'] ?? "";
     if($type == 1){
         $list_cat = Category::where('title','like',"%$search%")->get();

         return json_encode($list_cat);
     }
    else{
        $list_tags = Tag::where('name','like',"%$search%")->get();
        return json_encode($list_tags);
    }

    }
    public function getMorePosts(Request $request)
    {
        if($request->ajax()){
            $posts = Post::with(['categories','user'])->paginate(10);
            return view('admin.inc.post_data',compact('posts'))->render();
        }

    }

}
