<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'role_name'=>'Quản lý ',
                'role_des'=>' Người quản lý hệ thống',
                'permission'=>'["area.view","area.add","area.delete","area.edit","category.view","category.add","category.delete","category.edit","news.view","news.add","news.delete","news.edit","realestate.view","realestate.received","realestate.add","realestate.delete","realestate.edit","contact.view","contact.delete","page.view","page.add","page.delete","page.edit","subscribe.view","subscribe.delete","sitemap.view","sitemap.edit","user.view","user.add","user.delete","user.edit","role.view","role.add","role.delete","role.edit","slider.view","slider.add","slider.delete","slider.edit","setting.view","setting.edit"]',
                'created_at'=>date('Y-m-d h:s:i')
            ],
            [
                'role_name'=>'Tác giả',
                'role_des'=>' Người viết bài',
                'permission'=>'[]',
                'created_at'=>date('Y-m-d h:s:i'),
            ]
        ]);
    }
}
