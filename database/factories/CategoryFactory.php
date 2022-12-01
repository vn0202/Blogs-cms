<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake('vi_VN')->unique()->text(5);

        return [
            //
            'title'=>$title,
            'slug'=>Str::of($title)->slug('-'),
            'creator'=>fake()->randomElement([1,2,3,4,5]),

        ];
    }
}
