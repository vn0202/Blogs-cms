<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $array_thumb = [
            'storage/posts/hinh-anh-tao-dong-luc.jpg',
            'storage/posts/giaotranhukrainegetty-crop-1655862677921-1665655230926-1666425840229.webp',
            'storage/posts/hinh-anh-suy-tu-1.jpg',
            'storage/posts/images.jpeg',
            'storage/posts/moi.png',
            'storgae/posts/nhan-van-la-gi-01.jpg',



        ];
        $name = fake()->sentence();
        return [
            //
            'title'=>$name,
            'description'=>fake()->paragraph(),
             'content'=>fake()->text(500),
            'thumb'=>fake()->randomElement($array_thumb),
            'author'=>fake()->numberBetween(1,10),
            'active'=>'1',
            'approvor'=>1,
            'category'=>fake()->numberBetween(1,5),
            'slug'=>Str::of($name)->slug('-'),
            'created_at'=>now(),
            'updated_at'=>now(),


        ];
    }
}
