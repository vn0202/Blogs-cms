<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostTags;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
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
        //handle if using the search
        if(!empty($search))
        {
            $isFilter = true;
            $tags = Tag::where('name','like',"%$search%")->paginate(10);
        }
        else {
            $tags = Tag::paginate(10)->appends($request->all());
        }
        return view('admin.tags.index',compact('title','tags','isFilter'));
    }
    public function create()
    {
        $title = "Them Tag";
        return view('admin.tags.add',compact('title'));
    }
    public function handleCreate(Request $request){
        //handle by call ajax when add Tag
             if(!empty($_POST['search'])) {
                 $slug = Str::of($_POST['search'])->slug('-');
                 $tag = Tag::firstOrCreate(
                     ['slug' => $slug],
                     [
                         'name' => $_POST['search']
                     ]);

                 return json_encode($tag);
             }
             //handle add tag by normal
             else{
                 $rules = [
                     'name'=>['required'],
                 ];
                 $messages =
                     [
                         'name.required'=>"Bạn chưa nhập tên tag",
                     ];
                 $this->validate($request,$rules,$messages);
                 $slug =  Str::of($request->name)->slug('-');
                 if(Tag::where('slug',$slug)->count())
                 {
                     return back()->withErrors(['name'=>"Tag đã tồn tại"]);
                 }
                 else{
                     $tag = new Tag();
                     $tag->name = $request->name;
                     $tag->slug = $slug;
                     $tag->save();
                     return back()->with('success','Created!');

                 }

             }
    }
    public function edit(int $id)
    {
        $title = "Chỉnh sửa Tag";
        $tag = Tag::find($id);
        return view('admin.tags.edit',compact('title','tag'));
    }
    public function handleEdit(Request $request, int $id)
    {
        $rules = [
            'name'=>"required",
        ];
        $messages = [
            'name.required'=>"Ban chua nhap ten tag",
        ];

        $this->validate($request,$rules,$messages);
        $slug =  Str::of($request->name)->slug('-');
        if(Tag::where('slug',$slug)->count())
        {
            return back()->withErrors(['name'=>"Tag đã tồn tại"]);
        }
        else{
            $tag = Tag::find($id);
            $tag->name = $request->name;
            $tag->slug = $slug;
            $tag->save();
            return back()->with('success','Updated!');

        }

    }
    public function  delete(int $id)
    {
        //check  this tag whether relative to other post
        if(PostTags::where('tag_id',$id)->count())
        {
            return back()->with('failure',"Tag này còn một số bài viết liên quan chưa thể xóa");

        }
        else{
            Tag::destroy($id);
            return back()->with('success',"Deleted");
        }

    }
    public function get_list_tag(Request $request){
        $search = $request->search;
        $post_id = $request->post_id ?? '';

        if($search)
        {
            $list_tags = Tag::select('id','name')->where('name','like',"%".$search."%")
                ->limit(10)->get();

        }
        else{
            $list_tags = Tag::select('id','name')
                ->limit(10)->get();
        }
        $tags = [];
     foreach ($list_tags as $tag)
     {

             $tags[] = [
                 'id'=>$tag->id,
                 'text'=>$tag->name,

             ];
     }
        return response()->json($tags);
    }
    public function get_available_tags(int $post_id){

         $list_tag = Tag::whereHas('posts',function (Builder $query) use($post_id){
             $query->where('post_id',$post_id);
         })->select('id','name')->get();
         $tags =[];
         foreach ($list_tag as $tag)
         {
             array_push($tags, ['id'=>$tag->id, 'text'=>$tag->name, 'selected'=>'true',]);

         }





        return response()->json($tags);
    }

}
