<?php

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
        //factory(\App\Category::class, 10)->create();

//        $category = new \App\Category;
//        $category->name = "Features";
//        $category->slug = "features";
//        $category->save();
//
//        $category = new \App\Category;
//        $category->name = "Food";
//        $category->slug = "food";
//        $category->save();

        $categories = [
            ['name' => 'Features', 'slug' => 'features', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Food', 'slug' => 'food', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Travel', 'slug' => 'travel', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Recipe', 'slug' => 'recipe', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Bread', 'slug' => 'bread', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Breakfast', 'slug' => 'breakfast', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Meat', 'slug' => 'meat', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Fastfood', 'slug' => 'fastfood', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Salad', 'slug' => 'salad', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Soup', 'slug' => 'soup', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ];
        DB::table('categories')->insert($categories);

        factory(\App\User::class, 10)->create();

        factory(\App\Tag::class, 10)->create();

        factory(\App\Post::class, 50)->create();

        $posts = \App\Post::all();
        $post_tag = [];
        foreach($posts as $post)
        {
            $limit = rand(3, 6);
            $tags = \App\Tag::inRandomOrder()->limit($limit)->get();
            foreach ($tags as $tag) {
                $post_tag[] = [
                    'post_id' => $post->id,
                    'tag_id' => $tag->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
        }
        DB::table('post_tag')->insert($post_tag);

        factory(\App\Comment::class, 400)->create();
    }
}
