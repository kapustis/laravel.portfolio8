<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogChannelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channels = [];

        $cName = 'Без категории';
        $channels[] = [
            'name' => $cName,
            'slug' => Str::slug($cName),
            'parent_id' => 0,
        ];
        for ($i = 2; $i <= 11; $i++) {
            $cName = 'Категория №' . $i;
            $parentId = ($i > 4) ? rand(1, 4) : 1;

            $channels[] = [
                'name' => $cName,
                'slug' => Str::slug($cName),
                'parent_id' => $parentId,
            ];
        }
        DB::table('blog_channels')->insert($channels);
    }
}
