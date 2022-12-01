<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostTags;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostTagsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PostTags::class;
    public function definition()
    {
        $list_post = Post::pluck('id')->toArray();
        $list_tag = Tag::pluck('id')->toArray();
        return [
            //
            'tag_id'=>fake()->randomElement($list_tag),
            'post_id'=>fake()->randomElement($list_post),
        ];
    }
}
