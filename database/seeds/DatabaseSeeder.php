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
            ['name' => 'Features', 'slug' => 'features'],
            ['name' => 'Food', 'slug' => 'food'],
            ['name' => 'Travel', 'slug' => 'travel'],
            ['name' => 'Recipe', 'slug' => 'recipe'],
            ['name' => 'Bread', 'slug' => 'bread'],
            ['name' => 'Breakfast', 'slug' => 'breakfast'],
            ['name' => 'Meat', 'slug' => 'meat'],
            ['name' => 'Fastfood', 'slug' => 'fastfood'],
            ['name' => 'Salad', 'slug' => 'salad'],
            ['name' => 'Soup', 'slug' => 'soup'],
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
                    'created_at' => date('Y-m-d'),
                    'updated_at' => date('Y-m-d'),
                ];
            }
        }
        DB::table('post_tag')->insert($post_tag);
    }
}
