<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Request;

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

    public function store(CategoryRequest $request)
    {
      CategoryService::store($request);
        return back()->with('success', "Bạn đã thêm danh mục thành công ");
    }

    public function update(int $id)
    {

        $title = "Chỉnh sửa danh mục";
        $categories = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();
        $cat = Category::find($id);
        $cat_title = isset($cat->category_id) ? $cat->childItSelf->title : " Danh mục gốc";

        return view('admin.category.edit', compact('categories', 'cat', 'title', 'cat_title'));
    }

    public function save(UpdateCategoryRequest $request, int $id)
    {
        CategoryService::save($request, $id);
        return back()->with('success',"Update successfully");
    }
    public function delete(int $id)
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

