<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'loai_hinh_thuc_bds'=>'moi_gioi',
                    "type"=>'userAdminDefault',
                    'username'=>'24hcode',
                    'roleID'=>NULL,
                    'email' => 'dinhvanlanh.it@gmail.com',
                    'phone'=> '0966334404',
                    'password' => bcrypt('123456'),
                    'avatar'=>null,//$faker->gravatarUrl(),
                    'full_name'=>'Admin',
                    'sex'=>'male',
                    'about'=>"CODE VÌ ĐAM MÊ",
                    'birthday'=>'1996-12-02',
                    'address'=>'Thôn KaTu - Xã Sơn Hạ - Huyện Sơn Hà - Tỉnh Quảng Ngãi',
                    'status'=>0,
                    'darkMode'=>'off',
                    'cmnd_number'=>"212416993",
                    'cmnd_date'=>'2013-03-21',
                    'cmnd_address'=>'Quảng ngãi',
                    'created_at'=>date('Y-m-d h:s:i')
                ],
                [
                    'loai_hinh_bds'=>'chu_nha',
                    "type"=>'userAdminCreate',
                    'username'=>'dinhthinamsha',
                    'roleID'=>1,
                    'email' => 'dinhthinamsha@gmail.com',
                    'phone'=> '0966334409',
                    'password' => bcrypt('123456'),
                    'avatar'=>null,//$faker->gravatarUrl(),
                    'full_name'=>'Đinh Thị Nam',
                    'sex'=>'male',
                    'about'=>"CODE VÌ ĐAM MÊ",
                    'birthday'=>'1994-02-02',
                    'address'=>'Thôn KaTu - Xã Sơn Hạ - Huyện Sơn Hà - Tỉnh Quảng Ngãi',
                    'status'=>0,
                    'darkMode'=>'off',
                    'cmnd_number'=>"212416993",
                    'cmnd_date'=>'2013-03-21',
                    'cmnd_address'=>'Quảng ngãi',
                    'created_at'=>date('Y-m-d h:s:i')
                ],
            ]
        );

    }
}
