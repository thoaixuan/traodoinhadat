<?php

use Illuminate\Database\Seeder;

class RealestateSaveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=20;$i++){
            DB::table('realestate_save')->insert(['user_id'=>1,'realestate_id'=>$i]);
        }
    }
}
