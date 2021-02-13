<?php

namespace Database\Seeders;

use App\Models\BlogChannel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BlogChannelTableSeeder::class);
        // \App\Models\User::factory(10)->create();

    }
}
