<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert(
            [
                'logo'=>'',
                'icon'=>'',
                'name'=>'BDS',
                'title'=>'BDS ',
                'des'=>'bds - Tin tức, chia sẻ kiến thức, khóa học lập trình, Tải source code free, Download source code free',
                'keywords'=>'bds, Chia sẽ ,  Tin tức , học tập , kinh nghiệm ',
                'MAIL_DRIVER'=>'smtp',
                "MAIL_HOST"=>'smtp.gmail.com',
                "MAIL_PORT"=>'587',
                "MAIL_FROM_ADDRESS"=>'freelancertestcode@gmail.com',
                "MAIL_FROM_NAME"=>"BDS",
                "MAIL_ENCRYPTION"=>'tls',
                "MAIL_USERNAME"=>"freelancertestcode@gmail.com",
                "MAIL_PASSWORD"=>"freelancertestcodemail",
                "MAIL_RECEIVE"=>"dinhvanlanh.it@gmail.com",
                "contact_mail"=>'dinhvanlanh.it@gmail.com',
                "contact_phone"=>"0966334404",
                "contact_address"=>"Admin setting thiếu trường này",
                "about"=>"Đây là công đồng tennis số 1 đà lạt",
                "license"=>'',
                "iframe_map"=>'<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3903.2862576550974!2d108.44018161462591!3d11.954671891528665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317112da2b5c0cad%3A0xe438c0439913bfcf!2zMSDEkMaw4budbmcgUC4gxJAgVGhpw6puIFbGsMahbmcsIFBoxrDhu51uZyA4LCBUaMOgbmggcGjhu5EgxJDDoCBM4bqhdCwgTMOibSDEkOG7k25nLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1615694553880!5m2!1svi!2s" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                "twitter_url"=>"https://twitter.com/",
                "facebook_url"=>"https://facebook.com/",
                "youtube_url"=>"https://youtube.com/",
                "instagram_url"=>"https://www.instagram.com/",
                'licenseName'=>'fdev.tennis.com',
                'licenseKey'=>'EYNYLKSW1SFXX23JWUE4QXMSK7UM9',
                'AdSense'=>'',

                'facebook_client_id'=>'',
                'facebook_client_secret'=>'',
                'facebook_redirect'=>'',

                'google_client_id'=>'728903266054-q8q2ssb6pdjb8tm9516drmndu8n4v5jb.apps.googleusercontent.com',
                'google_client_secret'=>'awSBXk3Eq4zrGooD1Ybqo8pp',
                'google_redirect'=>'',


            ]
        );
    }
}
