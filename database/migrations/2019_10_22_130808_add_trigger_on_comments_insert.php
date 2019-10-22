<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTriggerOnCommentsInsert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            create trigger comment_increment 
            after insert on `comments` for each row
            begin
                update `posts`
                set `comments` = `comments` + 1
                where `id` = new.post_id;
            end');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `comment_increment`');
    }
}
