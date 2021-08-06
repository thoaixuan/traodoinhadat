<?php

use Illuminate\Database\Seeder;
use App\Models\Realestate;
use Cviebrock\EloquentSluggable\Services\SlugService;
class RealestateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id_categorys= DB::table('categorys')->where('cate_type','=','cate_buy')->where('cate_type_form','=','NHA')->pluck('id')->toArray();
        $id_categorys = implode("",$id_categorys);
        $id_users= DB::table('users')->limit(2)->pluck('id')->toArray();
        $id_users = implode("",$id_users);
        \File::deleteDirectory(public_path("/uploads/_realestate"));
        \File::deleteDirectory(public_path("/uploads/realestate"));
        \File::makeDirectory(public_path("/uploads/realestate"));
        \File::makeDirectory(public_path("/uploads/_realestate"));
        \File::makeDirectory(public_path("/uploads/_realestate/min"));
        \File::makeDirectory(public_path("/uploads/_realestate/max"));
        $faker = Faker\Factory::create();
        for($i=1;$i<=50;$i++){
            $title =$i%2==0?"Mua bán nhà tại thành phố đà lạt tỉnh lầm đồng  $i":"Cho thuê nhà tại thành phố đà lạt tỉnh lầm đồng $i";
            if($i<=15){
                $row['realestate_hot']='on';
            }else{
                $row['realestate_hot']='off';
            }
            $row['realestate_nha_huong'] = ($i%2==0?"1":"2");
            $row['realestate_nha_hem'] = ($i%2==0?"1":"2");

            $row['provinceID'] =7;
            $row['districtID'] =1;
            $row['wardID'] =null;

            $row['realestate_nha_phongngu']=($i%2==0?"1":"2");
            $row['realestate_nha_phongtam']=($i%2==0?"1":"2");
            $row['user_id']=intval(RandomString(1,str_replace('0','',$id_users)));
            if($i<=10){
                $row['cate_type']='cate_project';
                $row['realestate_hot']='on';
            }else{
                $row['cate_type']=$i%2==0?'cate_buy':'cate_lease';
                $row['category_id']=intval(RandomString(1,$id_categorys));
            }
            $row['realestate_dat_giayto']=$i%2==0?'1':'2';
            $row['realestate_price'] =500000000+$i;
            $row['realestate_title'] =$title;
            $row['realestate_view'] =150+$i;
            $row['realestate_slug'] = SlugService::createSlug(Realestate::class, 'realestate_slug', $row['realestate_title'],['unique' => true]);
            $row['realestate_tien_ich']="Test realestate_tien_ich";
            $row['realestate_mota']="Test realestate_mota";

            $row['realestate_time']=time();
            $row['created_at'] =date('Y-m-d h:s:i');
            $row['updated_at'] =date('Y-m-d h:s:i');

            \File::makeDirectory(public_path("/uploads/realestate/realestateID{$i}"));
            DB::table('realestate')->insert($row);
        }

    }
}
