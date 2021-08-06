<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealestateViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP VIEW IF EXISTS realestate_view');
        DB::unprepared("CREATE VIEW realestate_view AS
           SELECT * FROM (SELECT
            realestate.*,
            categorys.cate_name,
            categorys.cate_type_form,
            categorys.cate_slug,
            province.province_name,
            province.province_slug,
            district.district_name,
            district.district_slug,
            ward.ward_name,
            ward.ward_slug,
            users.avatar,
            users.email,
            users.roleID,
            users.full_name,
            users.sex,
            users.phone
            FROM realestate
            LEFT JOIN users ON users.id = 	realestate.user_id
            LEFT JOIN categorys ON categorys.id = realestate.category_id
            LEFT JOIN province ON province.id = realestate.provinceID
            LEFT JOIN district ON district.id = realestate.districtID
            LEFT JOIN ward ON ward.id = realestate.wardID ) AS web
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('realestate_view');
    }
}
