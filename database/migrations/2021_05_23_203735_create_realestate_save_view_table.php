<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealestateSaveViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP VIEW IF EXISTS realestate_save_view');
        DB::unprepared("CREATE VIEW realestate_save_view AS
            SELECT realestate_save.user_id AS save_user_id,realestate_view.* FROM  realestate_save
            JOIN realestate_view
            ON realestate_save.realestate_id = realestate_view.id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('realestate_save_view');
    }
}
