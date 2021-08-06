<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('user_id')->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
                $table->unsignedBigInteger('category_id')->nullable();
                $table->foreign('category_id')->references('id')->on('categorys')->onUpdate('cascade');
                $table->string("post_view_type")->nullable()->default('POST');
                $table->string('post_image_max')->nullable();
                $table->string('post_image_min')->nullable();

                $table->longText('post_title')->nullable();
                $table->longText('post_slug')->nullable();
                $table->longText('post_keywords')->nullable();
                $table->longText("post_des")->nullable();
                $table->bigInteger('post_view')->nullable();
                $table->bigInteger('post_share')->nullable();
                $table->longText('post_content')->nullable();
                $table->integer("post_time")->nullable();
                $table->string('post_status')->nullable()->default("published");
                $table->string('post_status_hot')->nullable()->default("off");
                $table->integer("post_trash")->nullable();
                $table->integer("post_trash_admin")->nullable();
                $table->string('post_status_admin')->nullable()->default("published");
                $table->string('page_link')->nullable();
                $table->string('page_link_type')->nullable()->default("newPage");
                $table->string('page_status_header')->nullable()->default("show");
                $table->string('page_status_footer')->nullable()->default("hide");
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
