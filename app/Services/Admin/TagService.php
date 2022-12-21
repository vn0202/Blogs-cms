<?php
namespace App\Services\Admin;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagService {


    public static function store(TagRequest $request)
    {
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->slug = Str::of($tag->name)->slug('-');
        $tag->save();
    }
    public function storeTagByAjax()
    {
        if (!empty($_POST['search'])) {
            $slug = Str::of($_POST['search'])->slug('-');
            $tag = Tag::firstOrCreate(
                ['slug' => $slug],
                [
                    'name' => $_POST['search']
                ]);

            return json_encode($tag);
        }
    }
    public  static  function  save(TagRequest $request, int $tag_id)
    {
        $slug = Str::of($request->name)->slug('-');
        $tag = Tag::find($tag_id);
        $tag->name = $request->name;
        $tag->slug = $slug;
        $tag->save();
    }
    public function get_list_tag(Request $request)
    {
        $search = $request->search;
        $post_id = $request->post_id ?? '';

        if ($search) {
            $list_tags = Tag::select('id', 'name')->where('name', 'like', "%" . $search . "%")
                ->limit(10)->get();

        } else {
            $list_tags = Tag::select('id', 'name')
                ->limit(10)->get();
        }
        $tags = [];
        foreach ($list_tags as $tag) {

            $tags[] = [
                'id' => $tag->id,
                'text' => $tag->name,

            ];
        }
        return response()->json($tags);
    }

    public function get_available_tags(int $post_id)
    {

        $list_tag = Tag::whereHas('posts', function (Builder $query) use ($post_id) {
            $query->where('post_id', $post_id);
        })->select('id', 'name')->get();
        $tags = [];
        foreach ($list_tag as $tag) {
            array_push($tags, ['id' => $tag->id, 'text' => $tag->name, 'selected' => 'true',]);

        }
        return response()->json($tags);
    }


}
