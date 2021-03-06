<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'titulo'=>$this->faker->unique()->sentence(),
            'contenido'=>$this->faker->text(),
            'status'=>rand(1,2),
            'img'=>'imgs/'.$this->faker->image('public/storage/imgs/', 640, 480, null, false),
            'user_id'=>User::all('id')->random()
        ];
    }
}
