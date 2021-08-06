<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategorysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // TIN TỨC
        $array=array(
            ['cate_order'=>1,'name'=>'TIN TỨC'],
            ['cate_order'=>2,'name'=>'KIẾN THỨC'],
            ['cate_order'=>3,'name'=>'TRUYỀN THÔNG'],
            ['cate_order'=>4,'name'=>'TỔNG HỢP'],
            ['cate_order'=>5,'name'=>'GÓC TƯ VẤN'],
        );
        foreach($array as $value){
             DB::table('categorys')->insert([
                'cate_type'=>'cate_news',
                'cate_parentID'=>NULL,
                'cate_name'=>$value['name'],
                'cate_slug'=>to_slug($value['name']),
                'cate_order'=>$value['cate_order'],
                "created_at"=>date('Y-m-d h:s:i')
            ]);
        }
        // BẤT ĐỘNG SẢN Mua
        $array=array(
            ['cate_order'=>1,'name'=>'Nhà riêng','cate_type_form'=>"NHA"],
            ['cate_order'=>2,'name'=>'Căn hộ','cate_type_form'=>"NHA"],
            ['cate_order'=>3,'name'=>'Đất nền','cate_type_form'=>"DAT"],
            // ['cate_order'=>4,'name'=>'Đất nền dự án','cate_type_form'=>"DAT"],
        );
        foreach($array as $value){
            DB::table('categorys')->insert([
               'cate_type'=>'cate_buy',
               'cate_parentID'=>NULL,
               'cate_name'=>$value['name'],
               'cate_slug'=>to_slug($value['name']),
               'cate_order'=>$value['cate_order'],
               'cate_type_form'=>$value['cate_type_form'],
               "created_at"=>date('Y-m-d h:s:i')
           ]);
        }
        $array=array(
            ['cate_order'=>1,'name'=>'Nhà riêng','cate_type_form'=>"NHA"],
            ['cate_order'=>2,'name'=>'Căn hộ','cate_type_form'=>"NHA"],
        );
        foreach($array as $value){
            DB::table('categorys')->insert([
               'cate_type'=>'cate_lease',
               'cate_parentID'=>NULL,
               'cate_name'=>$value['name'],
               'cate_slug'=>to_slug($value['name']),
               'cate_order'=>$value['cate_order'],
               'cate_type_form'=>$value['cate_type_form'],
               "created_at"=>date('Y-m-d h:s:i')
           ]);
       }
       $array=array(
        ['cate_order'=>1,'name'=>'Đất','cate_type_form'=>"DAT"],
        );
        // foreach($array as $value){
        //     DB::table('categorys')->insert([
        //        'cate_type'=>'cate_project',
        //        'cate_parentID'=>NULL,
        //        'cate_name'=>$value['name'],
        //        'cate_slug'=>to_slug($value['name']),
        //        'cate_order'=>$value['cate_order'],
        //        'cate_type_form'=>$value['cate_type_form'],
        //        "created_at"=>date('Y-m-d h:s:i')
        //    ]);
        // }
    }
}
