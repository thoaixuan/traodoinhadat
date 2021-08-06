<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealestateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realestate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id_send')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categorys')->onUpdate('cascade');

            $table->unsignedBigInteger('provinceID')->nullable();
            $table->foreign('provinceID')->references('id')->on('province')->onUpdate('cascade');

            $table->unsignedBigInteger('districtID')->nullable();
            $table->foreign('districtID')->references('id')->on('district')->onUpdate('cascade');

            $table->unsignedBigInteger('wardID')->nullable();
            $table->foreign('wardID')->references('id')->on('ward')->onUpdate('cascade');

            $table->string('realestate_top')->nullable('off');

            $table->string('realestate_hot')->nullable('off');

            $table->string('realestate_expertise')->nullable('off');

            $table->string('realestate_sold')->nullable('off');


            $table->string('cate_type')->nullable();
            $table->longText('realestate_title')->nullable();
            $table->longText('realestate_slug')->nullable();
            $table->bigInteger('realestate_view')->nullable();
            $table->integer("realestate_time")->nullable();
            $table->string('realestate_status')->nullable()->default("published");

            $table->string('realestate_nha_huong')->nullable();
            $table->string('realestate_nha_phongngu')->nullable()->default("0");
            $table->string('realestate_nha_phongtam')->nullable()->default("0");
            $table->string('realestate_nha_tan')->nullable()->default("1");
            $table->string('realestate_nha_giayto')->nullable();
            $table->string('realestate_nha_chieudai')->nullable();
            $table->string('realestate_nha_chieurong')->nullable();
            $table->string('realestate_nha_hem')->nullable();

            $table->string('realestate_dat_dientich')->nullable();
            $table->string('realestate_dat_giayto')->nullable();

            $table->longText('realestate_tien_ich')->nullable();
            $table->longText('realestate_mota')->nullable();
            $table->double('realestate_price')->nullable();


            $table->string('loai_hinh_thuc_bds')->nullable();
            $table->string('send_cate_type')->nullable();
            $table->string('send_category_id')->nullable();
            $table->text('send_realestate_mota')->nullable();

            $table->string('send_chinh_chu')->nullable();

            $table->string('send_name_agent')->nullable();
            $table->string('send_phone_agent')->nullable();
            $table->string('send_email_agent')->nullable();

            $table->string('send_chu_nha_full_name')->nullable();
            $table->string('send_chu_nha_phone')->nullable();
            $table->string('send_chu_nha_email')->nullable();

            $table->string('send_house_number')->nullable();
            $table->string('send_house_address')->nullable();

            $table->double('send_realestate_price')->nullable();
            $table->double('send_realestate_price_rent')->nullable();

            $table->string('send_nhucau_thamdinh')->nullable()->default("off");
            $table->string('send_nhucau_cungcapthongtin')->nullable()->default("off");
            $table->string('send_nhucau_hoangthienhoso')->nullable()->default("off");

            $table->integer('send_realestate_time')->nullable();

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
        Schema::dropIfExists('realestate');
    }
}
