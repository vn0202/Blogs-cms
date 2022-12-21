<?php
namespace  App\Services\Admin;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryService{


    public static  function  store(CategoryRequest $request)
    {
        $cat = new Category();
        $cat->title = $request->title;
        $cat->slug = Str::of($request->title)->slug('-');
        $cat->creator = Auth::user()->id;
        if ($request->category) {
            $cat->category_id = $request->category;
        }
        $cat->save();
    }
    public static function save(UpdateCategoryRequest $request, int $id)
    {
        $cat = Category::find($id);
        $cat->title = $request->title;
        $cat->category_id = $request->category;
        $cat->save();
    }
}
