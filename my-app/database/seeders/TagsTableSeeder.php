<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $tags = [
            ['name' => '赤い'],
            ['name' => '白い'],
            ['name' => '青い'],
            ['name' => '緑'],
            ['name' => '黄色'],
        ];

        DB::table('tags')->insert($tags);
    }
}
