<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Services\Admin\PostService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index(Request $request)
    {

        $isFilter = true;
        if (!empty($request->search)) {
          $posts = PostService::search($request);
        } elseif ($request->category_id ||$request->tag_id) {
            $posts = PostService::filter($request);
        } else {
            $posts = Post::with(['categories', 'user'])->paginate(10)->withQueryString();
            $isFilter = false;
        }
        $title = "Danh sách bài viết ";
        return view('admin.posts.list', compact('title', 'posts', 'isFilter'));
    }

    public function create()
    {
        $title = "Thêm bài viết mới ";
        $categories = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();
        return view('admin.posts.add', compact('title', 'categories'));
    }

    public function show(int $id)
    {
        $title = "Bài viết";
        $post = Post::find($id);
        $list_tags = Tag::whereHas('posts', function (Builder $query) use ($id) {
            return $query->where('post_id', $id);
        })->get();

        return view('admin.posts.show', compact('title', 'post', 'list_tags'));

    }

    public function store(PostRequest $request)
    {
        PostService::store($request);
        return back()->with('success', "Created!");

    }

    public function update(Request $request, int $id)
    {
        $this->middleware("authorOrAdminRole:$id");
        $title = "Chỉnh sửa bài viết";
        $categories = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();
        $post = Post::find($id);
        return view('admin.posts.edit', compact('title', 'post', 'categories'));

    }

    public function save(UpdatePostRequest $request, int $id)
    {
        PostService::save($request, $id);
        return back()->with('success', "Updated!");
    }

    public function delete(int $id)
    {
        $this->middleware("authorOrAdminRole:$id");
        Post::destroy($id);
        return back()->with('success', 'Deleted!');
    }


}
