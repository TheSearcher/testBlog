<?php

namespace Database\Factories;

use App\Models\Post;
use Faker\Factory as Faker;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence(2);

        return [
            'user_id'    => User::all()->random()->id,
            'title'      =>  rtrim($title, '.'),
            'body'       =>  $this->faker->paragraph(12),
            'email_sent' => $this->faker->boolean(),
            'created_at' => $this->faker->dateTimeBetween('-5 week', '+1 week')
        ];
    }
}
