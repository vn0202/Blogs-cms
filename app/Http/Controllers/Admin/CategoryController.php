<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

use mysql_xdevapi\Exception;
use Psy\Output\ProcOutputPager;

class CategoryController extends Controller
{
    //
    public function index(Request $request)
    {

        $search = $request->search ?? '';
        $isFilter = false;
        if($search != ''){
            $categories = Category::where('title', 'like', '%'.$search.'%')->paginate(10);
            $isFilter = true;
        }
        else{
            $categories = Category::paginate(10);
        }
        $data['title'] = "Categories";
        $data['categories'] = $categories;
        $data['search'] = $search;
        $data['isFilter']  = $isFilter;
        return view('admin.category.list', $data);
    }

    public function create()
    {
        $title = "Thêm danh mục";
        $categories = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();

        return view('admin.category.add', compact('categories', 'title'));

    }

    public function store(Request $request)
    {
        $rules = [
            'title' => ['required', 'unique:categories,title'],
        ];
        $message = [
            'title.required' => "Bạn chưa nhập tên danh mục",
        ];
        $this->validate($request, $rules, $message);
        $cat = new Category();
        $cat->title = $request->title;
        $cat->slug = Str::of($request->title)->slug('-');
        $cat->creator = Auth::user()->id;
        if ($request->category) {
            $cat->category_id = $request->category;
        }
        $cat->save();
        return back()->with('success', "Bạn đã thêm danh mục thành công ");
    }

    public function edit(int $id)
    {
        $title = "Chỉnh sửa danh mục";
        $categories = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();
        $cat = Category::find($id);
        $cat_title = isset($cat->category_id) ? $cat->childItSelf->title : " Danh mục gốc";

        return view('admin.category.edit', compact('categories', 'cat', 'title', 'cat_title'));
    }

    public function handleEdit(Request $request, int $id)
    {
        $rules = [
            'title'=>['required',Rule::unique('categories')->ignore($id)],
        ];
        $messages = [
            'title.required'=>'Bạn không được để trống danh mục này',
            'title.unique'=>"Danh mục này đã tồn tại"
        ];
        $this->validate($request, $rules, $messages);
        $cat = Category::find($id);
        $cat->title = $request->title;
        $cat->category_id = $request->category;
        $cat->save();
        return back()->with('success',"Update successfully");
    }
    public function destroy(int $id)
    {
         $cat_relative = Category::where('category_id',$id)->count();
         if($cat_relative > 0)
         {
             return back()->with('failure',"Không thể xóa! Danh mục này còn các danh mục bài viết liên quan ");
         }
         Category::destroy($id);
         return back()->with('success',"Deleted!");
    }


}

