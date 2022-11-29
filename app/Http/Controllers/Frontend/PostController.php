<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
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
