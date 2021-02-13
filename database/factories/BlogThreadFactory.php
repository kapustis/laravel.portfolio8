<?php

namespace Database\Factories;

use App\Models\BlogChannel;
use App\Models\BlogThread;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogThreadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogThread::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        return [
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'channel_id' => rand(1,2)
//                function () {
//                    return BlogChannel::factory()->create()->id;
//                }
            ,
            'locked' => false,
            'title' => $title,
            'slug' => Str::slug($title),
//        'images' => rand(1,2).'_b.jpeg',
            'body' => "<div>" . $this->faker->paragraph . "</div>",
            'views' => 0
        ];
    }
}
