<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->getCustomData()->commentator_id,
            'body'    =>  $this->faker->text(550),
            'post_id' => $this->getCustomData()->post_id,
            'created_at' => $this->faker->dateTimeThisMonth()
        ];
    }

    public function getCustomData(){

        return  DB::table('posts as p')
                ->select('p.user_id')
                ->inRandomOrder()
                ->leftjoin('users as member', 'p.user_id', '=', 'member.id')
                ->select('p.id as post_id','p.user_id as author_id',
                    DB::raw("(SELECT id FROM users as k
                                where k.id <> author_id
                                ORDER BY RAND()
                                LIMIT 1
                            ) as commentator_id"))
                ->first();
    }
}
