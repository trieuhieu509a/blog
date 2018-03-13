<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new \App\Post([
            'title' => 'article 1',
            'content' => '111111111111111111',
            'is_active' => 1,
            'user_id' => 1
        ]);
        $post->save();

        $post = new \App\Post([
            'title' => 'article 2',
            'content' => '2222222222222222222',
            'is_active' => 0,
            'user_id' => 1
        ]);
        $post->save();

        $post = new \App\Post([
            'title' => 'article 3',
            'content' => '33333333333333333',
            'is_active' => 0,
            'user_id' => 1
        ]);
        $post->save();

        $post = new \App\Post([
            'title' => 'article 4',
            'content' => '444444444444444',
            'is_active' => 0,
            'user_id' => 1
        ]);
        $post->save();

        $post = new \App\Post([
            'title' => 'article 5',
            'content' => '555555555555555',
            'is_active' => 0,
            'user_id' => 1
        ]);
        $post->save();
    }
}
