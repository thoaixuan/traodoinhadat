<?php

use Illuminate\Database\Seeder;

class SliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=4;$i++){
            DB::table('slider')->insert([
                [
                    'type'=>'home',
                    'name'=>"slider $i",
                    'link'=>null,
                    'image'=>"/themes/web/img/banner-$i.jpg",
                    'created_at'=>date('Y-m-d h:s:i')
                ],
            ]);
        }
        for($i=1;$i<=5;$i++){
            DB::table('slider')->insert([
                [
                    'type'=>'uudai',
                    'name'=>"slider $i",
                    'link'=>null,
                    'image'=>"/themes/web/img/noi-bat-$i.jpg",
                    'created_at'=>date('Y-m-d h:s:i')
                ],
            ]);
        }
        for($i=1;$i<=2;$i++){
            DB::table('slider')->insert([
                [
                    'type'=>'sendBDS',
                    'name'=>"slider $i",
                    'link'=>null,
                    'image'=>"/themes/web/img/dangtin$i.jpg",
                    'created_at'=>date('Y-m-d h:s:i')
                ],
            ]);
        }

    }
}
