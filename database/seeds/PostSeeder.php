<?php

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Event;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::flushEventListeners();

        factory(Post::class, 50)->create();
    }
}
