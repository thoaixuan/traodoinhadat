<?php

use Illuminate\Database\Seeder;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Posts;
class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */





    public function run()
    {
        $id_categorys= DB::table('categorys')->where('cate_type','=','cate_news')->limit(8)->pluck('id')->toArray();
        $id_categorys = implode("",$id_categorys);
        $id_users= DB::table('users')->limit(2)->pluck('id')->toArray();
        $id_users = implode("",$id_users);
        \File::deleteDirectory(public_path("/uploads/_posts"));
        \File::deleteDirectory(public_path("/uploads/posts"));
        \File::makeDirectory(public_path("/uploads/posts"));
        \File::makeDirectory(public_path("/uploads/_posts"));
        \File::makeDirectory(public_path("/uploads/_posts/min"));
        \File::makeDirectory(public_path("/uploads/_posts/max"));
        $faker = Faker\Factory::create();
        $d = 0;
        for($i=1;$i<=50;$i++){
            $d++;
            if($d>30){
                $d=1;
            }
            if($d<=9){
                $d="0{$d}";
            }
            $title =  $i==1?'Vì sao mua nhà bị lỗi phong thủy mà vẫn “Phất lên như diều gặp gió”?':$faker->name." ".$faker->title;
            $row['user_id']=intval(RandomString(1,str_replace('0','',$id_users)));
            $row['category_id']=intval(RandomString(1,$id_categorys));
            $row['post_title'] =$i." ".$title;
            $row['post_des'] ="Không cần bỏ ra số tiền lớn mua đất đầu tư chờ tăng giá hay mua một căn
            hộ
            hạng sang, xây căn hộ mini cho thuê đang là xu hướng đang được nhiều gia chủ lựa chọn bởi những
            lợi ích kinh tế mang tính lâu dài. Mặc dù vậy, làm sao để đầu tư mang lại lợi nhuận cao thì
            không
            phải ai cũng biết, cùng khám phá…";
            $row['post_view'] =150+$i;
            $row['post_share'] =10+$i;
            $row['post_slug'] = SlugService::createSlug(Posts::class, 'post_slug', $row['post_title'],['unique' => true]);
            $row['post_content']=file_get_contents(base_path('public/post.html'));
            $row['created_at'] =date("Y-m-{$d} h:s:i");
            $row['updated_at'] =date("Y-m-{$d} h:s:i");
            $row['post_time']=time();
            if($i>=35){
                $row['post_status_hot']='on';
            }else{
                $row['post_status_hot']='off';
            }
            \File::makeDirectory(public_path("/uploads/posts/postID{$i}"));
            DB::table('posts')->insert($row);
        }
        $postID = DB::table('posts')->insertGetId([
            'post_view_type'=>'PAGE',
            'post_title'=>'Giới thiệu',
            'post_slug'=>'gioi-thieu',
            'post_content'=>file_get_contents(base_path('public/uploads/about.html')),
            'created_at'=>date('Y-m-d h:s:i'),
            'updated_at'=>date('Y-m-d h:s:i'),
        ]);
        \File::makeDirectory(public_path("/uploads/posts/postID{$postID}"));

    }
}
