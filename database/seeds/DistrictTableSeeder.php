<?php

use Illuminate\Database\Seeder;

class DistrictTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function Insert_QuanHuyen_BaRiaVungTau($id)
     {
        $BaRiaVungTaus = array(
            "Bà Rịa",
            "Châu Đức",
            "Côn Đảo",
            "Đất Đỏ",
            "Long Điền",
            "Tân Thành",
            "TP Vũng Tàu",
            "Xuyên Mộc",
        );
        $BaRiaVungTau_insert = array();
        foreach ($BaRiaVungTaus as $value) {
            $row['provinceID']= $id;
            $row['district_name']= $value;
            $row['district_slug']= to_slug($value);
            $row['created_at']= date('Y-m-d h:s:i');
            $BaRiaVungTau_insert[]=$row;
        }
        DB::table('district')->insert($BaRiaVungTau_insert);
     }

    public function run()
    {
        $this->Insert_QuanHuyen_BaRiaVungTau(7);
    }
}
