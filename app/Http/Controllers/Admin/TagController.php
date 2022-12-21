<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\PostTags;
use App\Models\Tag;
use App\Services\Admin\TagService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    //
    public function index(Request $request)
    {
        $title = "Danh sach Tag";
        $isFilter = false;
        $search = $request->search;

        if (!empty($search)) {
            $isFilter = true;
            $tags = Tag::where('name', 'like', "%$search%")->paginate(10);
        } else {
            $tags = Tag::paginate(10)->appends($request->all());
        }
        return view('admin.tags.index', compact('title', 'tags', 'isFilter'));
    }

    public function create()
    {
        $title = "Them Tag";
        return view('admin.tags.add', compact('title'));
    }

    public function store(TagRequest $request)
    {
        $slug = Str::of($request->name)->slug('-');
        if (Tag::where('slug', $slug)->count()) {
            return back()->withErrors(['name' => "Tag đã tồn tại"]);
        }
        TagService::store($request);
        return back()->with('success', 'Created!');


    }

    public function update(int $id)
    {
        $title = "Chỉnh sửa Tag";
        $tag = Tag::find($id);
        return view('admin.tags.edit', compact('title', 'tag'));
    }

    public function save(TagRequest $request, int $id)
    {
        TagService::save($request,$id);
        return back()->with('success', 'Updated!');

    }

    public function delete(int $id)
    {
        //check  this tag whether relative to other post
        if (PostTags::where('tag_id', $id)->count()) {
            return back()->with('failure', "Tag này còn một số bài viết liên quan chưa thể xóa");

        } else {
            Tag::destroy($id);
            return back()->with('success', "Deleted");
        }

    }


}

