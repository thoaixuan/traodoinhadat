<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP VIEW IF EXISTS post_view');
        DB::unprepared("CREATE VIEW post_view AS
            SELECT
            posts.*,
            users.full_name,
            users.phone,
            users.email ,
            categorys.cate_parentID,
            categorys.cate_name,
            categorys.cate_slug,
            categorys.cate_slug_parent,
            categorys.cate_type
            FROM posts
            JOIN users
            ON users.id = posts.user_id
            JOIN categorys
            ON categorys.id = posts.category_id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_view');
    }
}
