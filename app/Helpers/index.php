<?php
use Illuminate\Support\Facades\DB;
use App\Repositories\Categorys\CategorysRepository;
use App\Repositories\Area\ProvinceRepository;
use App\Repositories\Users\UsersRepository;
use App\Repositories\Posts\PostsRepository;
use App\Repositories\Realestate\RealestateRepository;
use App\Models\Users;
use App\Models\Comments;
use App\Models\Follows;
use App\Models\Tags;
use App\Models\Categorys;
use App\Views\PostsView;
use App\Views\RealestateView;
use App\Models\Posts;
use App\Models\Roles;
use App\Models\Ad;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Views\UsersView;
use App\Models\Realestate;
use App\Views\RealestateSaveView;
use App\Models\Contact;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;

function sameCategory($cate_name,$postID,$limit=5)
{
    return  PostsView::where('post_view_type','=','POST')
    ->where('id','!=',$postID)
    ->where('cate_name','=',$cate_name)
    ->limit($limit)
    ->orderBy('created_at','desc')
    ->get();
}
function updatePostView($postID)
{
    $Posts = new PostsRepository();
    return $Posts->updatePostView($postID);
}
function countPostTopView($limit=10)
{
    RealestateView::orderBy('realestate_view','desc')->limit($limit)->count();
}
function getCategoryPost(){
    $Categorys = new CategorysRepository();
    $result =  $Categorys->getCategoryPost();
    return $result;
}
function getPostHots($limit = null)
{
    $PostsRepository = new PostsRepository();
    if($limit){
        $result =  $PostsRepository->getPostHots();
    }else{
        $result =  $PostsRepository->getPostHots($limit);
    }
    return $result;
}
function getPostHotRight()
{
    $PostsRepository = new PostsRepository();
    $result =  $PostsRepository->getPostHots(12);
    $i=0;
    $data = array();
    $array1 = array();
    $array2 = array();
    $array3 = array();
    foreach($result as $item){
        $i++;
        if($i>0&&$i<=4){
            $array1[]=$item;
            if($i==4){
                $data[]=$array1;
            }
        }
        if($i>4&&$i<=8){
            $array2[]=$item;
            if($i==8){
                $data[]=$array2;
            }
        }
        if($i>8&&$i<=12){
            $array3[]=$item;
            if($i==12){
                $data[]=$array3;
            }
        }
    }
    return $data;
}
function getPostLeft()
{
    $PostsRepository = new PostsRepository();
    $result =  $PostsRepository->getPostHots(3);
    $i=0;
    $std = new \stdClass;
    $std->std_8 = array();
    $std->std_4 = array();
    foreach($result as $item){
        $i++;
        if($i==1){
            $std->std_8[] = $item;
        }else{
            $std->std_4[] = $item;
        }
    }
    return $std;
}
function getPostRandoms($limit)
{
    $post = new PostsRepository();
    return $post->randomPosts($limit);
}
function getWeekPost($limit)
{
    $post = new PostsRepository();
    return $post->getWeekPost($limit);
}
function getSharePost($limit)
{
    $post = new PostsRepository();
    return $post->getWeekPost($limit);
}
function getListParent()
{
    return getCategoryPost();
}
function getSubMenu(){
    $result =  Categorys::where('cate_parentID','!=',NULL)->where('cate_type','=','cate_news')->get();
    return $result;
}
function getRealestateBuy()
{
    return Categorys::where('cate_type','=','cate_buy')->get();
}
function getRealestateLease()
{
    return Categorys::where('cate_type','=','cate_lease')->get();
}
function getRealestateProject()
{
    return Categorys::where('cate_type','=','cate_project')->get();
}

function getRoles()
{
    return Roles::get();
}
function countPosts()
{
    return  PostsView::where('post_view_type','=','POST')
    ->where('post_status','=','published')->count();
}
function countCategorys()
{
    return  Categorys::where('cate_type','=','cate_news')->count();
}
function countRealestateSend()
{
    return  RealestateView::where('realestate_status','=','send')->count();
}
function countRealestateTrans()
{
    return  RealestateView::where('cate_type','=','trao_doi')->count();
}
function countRealestatePublic()
{
    return  RealestateView::where('realestate_status','=','published')->count();
}
function countRealestateDraft()
{
    return  RealestateView::where('realestate_status','=','draft')->count();
}
function countRealestateLock()
{
    return  RealestateView::where('realestate_status','=','lock')->count();
}
function countRealestateSendWeb()
{
    return  RealestateView::where('realestate_status','=','send')->where('user_id_send','=',user()->id)->count();
}
function countRealestatePublicWeb()
{
    return  RealestateView::where('realestate_status','=','published')->where('user_id_send','=',user()->id)->count();
}

function countRealestateSave()
{
    if(Auth::check()){
        $count =   RealestateSaveView::where('save_user_id','=',user()->id)->count();
        return $count;
    }
    return 0;
}

function setting(){
   return \App\Models\Setting::find(1);
}
function to_slug($str){
    $str = trim(mb_strtolower($str));
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    $str = preg_replace('/([\s]+)/', '-', $str);
    return $str;
}
function configMail()
{
    \Config::set("mail.driver",setting()->MAIL_DRIVER);
    \Config::set("mail.host",setting()->MAIL_HOST);
    \Config::set("mail.port",setting()->MAIL_PORT);
    \Config::set("mail.from.address",setting()->MAIL_FROM_ADDRESS);
    \Config::set("mail.from.name",setting()->MAIL_FROM_NAME);
    \Config::set("mail.encryption",setting()->MAIL_ENCRYPTION);
    \Config::set("mail.username",setting()->MAIL_USERNAME);
    \Config::set("mail.password",setting()->MAIL_PASSWORD);
}
function _sendMail($data = array('template'=>"",'data'=>[],'mailSend'=>[],'subject'=>'FDEV'))
{

        $mailSends = $data['mailSend'];
        $subject = $data['subject'];
        try{
            \Mail::send($data['template'],$data['data'],function ($message) use ($mailSends,$subject) {
                $message->to($mailSends)->subject($subject);
            });
            return true;
        }
        catch(\Exception $exception)
        {
            return ($exception->getMessage());
        }
}
function raddomClass($nodark=false)
{
    $data=  ['info','danger','success','warning'];
    return $data[intval(RandomString(1,"0123"))];
}
function RandomString($length = 6,$string=null)
{

    $characters = $string==null?'123456789': $string;

    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function time_Ago($time) {
    $diff     = time() -$time;
    $sec     = $diff;
    $min     = round($diff / 60 );
    $hrs     = round($diff / 3600);
    $days     = round($diff / 86400 );
    $weeks     = round($diff / 604800);
    $mnths     = round($diff / 2600640 );
    $yrs     = round($diff / 31207680 );
    if($sec <= 60) {
        echo "$sec giây trước";
    }
    else if($min <= 60) {
        if($min==1) {
            return "1 phút trước";
        }
        else {
            return "$min phút trước";
        }
    }
    // Check for hours
    else if($hrs <= 24) {
        if($hrs == 1) {
            return "1 giờ trước";
        }
        else {
            return "$hrs giờ trước";
        }
    }
    // Check for days
    else if($days <= 7) {
        if($days == 1) {
            return "Hôm qua";
        }
        else {
            return "$days ngày trước";
        }
    }
    // Check for weeks
    else if($weeks <= 4.3) {
        if($weeks == 1) {
            return "1 tuần trước";
        }
        else {
            return "$weeks tuần trước";
        }
    }
    // Check for months
    else if($mnths <= 12) {
        if($mnths == 1) {
            return "1 tháng trước";
        }
        else {
            return "$mnths tháng trước";
        }
    }
    // Check for years
    else {
        if($yrs == 1) {
            return "1 năm trước";
        }
        else {
            return "$yrs năm trước";
        }
    }
}
function user()
{
   return Auth::user();
}
function countUserAdmin()
{
    return Users::where('status','=','0')->where('type','!=','userAdminDefault')->where('type','!=','userCreate')->count();
}
function countUserMembers ()
{
    return Users::where('status','=','0')->where('type','=','userCreate')->count();
}
function checkRole($key)
{
    $roles = collect(array());
    $data = Roles::where('id','=',(int)Auth::user()->roleID)->pluck('permission')->first();

    if (Auth::user()->type == 'userAdminDefault') {
        return true;
    } else {
        // Kiểm tra nếu là tài khoản mà được chọn là quyền userAdminDefault  trùm thì cho qua luôn full hiện thị full menu
        if($data){
            $roles = collect(json_decode($data));
        }
        if ($roles->contains($key)) {
            return true;
        } else {
            return false;
        }
    }
}

function getProvinces()
{
    return Province::get();
}
function getDistrictSetup()
{
    return District::where('provinceID','=',setting()->provinceID)->get();
}

function province_slug_default()
{
    $rs = Province::where('id','=',setting()->provinceID)->first();
    if($rs){
        return $rs->province_slug;
    }
    return "";
}
function district_slug_default()
{
    $rs = District::where('id','=',setting()->districtID)->first();
    if($rs){
        return $rs->district_slug;
    }
    return "";
}
function ward_slug_default()
{
    $rs = Ward::where('id','=',setting()->districtID)->first();
    if($rs){
        return $rs->ward_slug;
    }
    return "";
}

function getRealestate_Buy($limit=10)
{
    return RealestateView::where('cate_type','=','cate_buy')->orderBy('id','desc')->limit($limit)->get();
}
function getRealestate_Lease($limit=10)
{
    return RealestateView::where('cate_type','=','cate_lease')->orderBy('id','desc')->limit($limit)->get();
}
function getRealestate_project($limit=10)
{
    return RealestateView::where('cate_type','=','cate_project')->orderBy('id','desc')->limit($limit)->get();
}
function getRealestateHot($limit=10)
{
   return RealestateView::where('realestate_hot','=','on')->orderBy('id','desc')->limit($limit)->get();
}
function getRealestateHot_Buy($limit=10)
{
   return RealestateView::where('cate_type','=','cate_buy')->where('realestate_hot','=','on')->orderBy('id','desc')->limit($limit)->get();
}
function getRealestateHot_Lease($limit=10)
{
   return RealestateView::where('cate_type','=','cate_lease')->where('realestate_hot','=','on')->orderBy('id','desc')->limit($limit)->get();
}
function getRealestateHot_Project($limit=10)
{
   return RealestateView::where('cate_type','=','cate_project')->where('realestate_hot','=','on')->orderBy('id','desc')->limit($limit)->get();
}


function checkData($data)
{
    if($data.''=='0'||$data.''==""){
        return "Chưa xác định !";
    }
    return $data;
}
function getImageRealestate($id)
{
    $RealestateRepository = new RealestateRepository();
    $images = $RealestateRepository->getImage($id);
    $imgae = asset('uploads/defaults/img-df.png');
    if(count($images)>0){
        $imgae = $images[0];
    }
    return $imgae;
}
function countImageRealestate($id)
{
    $RealestateRepository = new RealestateRepository();
    $images = $RealestateRepository->getImage($id);
    return count($images);
}

function countContactStatus()
{
    return Contact::where('status','=','off')->count();

}
function listViTri()
{
    return array(
        ['value'=>"1",'text'=>"Hẻm"],
        ['value'=>"2",'text'=>"Mặt tiền"],
    );
}
function showVitri($value)
{
    foreach(listViTri() as $item){
        if($value==$item['value']){
            return $item['text'];
        }
    }
    return "Không xác định";
}
function listGiayTo()
{
    return array(
        ['value'=>"1",'text'=>"Đã có sổ"],
        ['value'=>"2",'text'=>"Chưa có sổ"],
    );
}
function listHuong()
{
   return array(
       ['value'=>"1",'text'=>"Đông"],
       ['value'=>"2",'text'=>"Tây"],
       ['value'=>"3",'text'=>"Nam"],
       ['value'=>"4",'text'=>"Bắc"],
       ['value'=>"5",'text'=>"Đông bắc"],
       ['value'=>"6",'text'=>"Tây bắc"],
       ['value'=>"7",'text'=>"Đông Nam"],
       ['value'=>"8",'text'=>"Tây nam"],
   );
}
function showHuong($value)
{
    foreach(listHuong() as $item){
        if($value==$item['value']){
            return $item['text'];
        }
    }
    return "Không xác định";
}
function showGiayTo($value)
{
    foreach(listGiayTo() as $item){
        if($value==$item['value']){
            return $item['text'];
        }
    }
    return "Không xác định";
}

function cateNameBySlug($_cateType,$cate_slug)
{
   $data =  Categorys::where('cate_type','=',_cateTypeSlug($_cateType))->where('cate_slug','=',$cate_slug)->first();
   if($data){
    return $data->cate_name;
   }
   return null;
}
function provinceNameBySlug($province_slug)
{
   $data =  Province::where('province_slug','=',$province_slug)->first();
   if($data){
    return $data->province_name;
   }
   return null;
}
function districtNameBySlug($district_slug)
{
   $data =  District::where('district_slug','=',$district_slug)->first();
   if($data){
    return $data->district_name;
   }
   return null;
}
function wardNameBySlug($ward_slug)
{
   $data =  Ward::where('ward_slug','=',$ward_slug)->first();
   if($data){
    return $data->ward_name;
   }
   return null;
}
function realestate_title($realestate_slug){
    $data =  RealestateView::where('realestate_slug','=',$realestate_slug)->first();
    if($data){
     return $data->realestate_title;
    }
    return null;
}
function cateTypeName($key)
{
    if($key=='cate_buy'||$key=='mua'){
        return 'Mua bán';
    }
    if($key=='cate_lease'||$key=='thue'){
        return 'Cho thue';
    }
    if($key=='cate_project'||$key=='du-an'){
        return 'Dự án';
    }
}
function cateTypeUrl($key)
{
    if($key=='cate_buy'){
        return 'mua';
    }
    if($key=='cate_lease'){
        return 'thue';
    }
    if($key=='cate_project'){
        return 'du-an';
    }
}
function _cateTypeSlug($key)
{
    if($key=='mua'){
        return 'cate_buy';
    }
    if($key=='thue'){
        return 'cate_lease';
    }
    if($key=='du-an'){
        return 'cate_project';
    }
}
function getRealestateUrl($data)
{
    $urls = array();
    $urls[]=cateTypeUrl($data->cate_type);
    if($data->cate_slug){
        $urls[]=$data->cate_slug;
    }
    if($data->province_slug){
        $urls[]=$data->province_slug;
    }
    if($data->district_slug){
        $urls[]=$data->district_slug;
    }
    if($data->ward_slug){
        $urls[]=$data->ward_slug;
    }
    if($data->realestate_slug){
        $urls[]=$data->realestate_slug;
    }
    return  route('web.realestate.all',$urls);
}
function breadcrumbs()
{
        $where = array();
        $request = request();
        $array = array();
        $slugs = explode("/",$request->path());
        $slug = array($slugs[0]);
        $cateTypeName = cateTypeName($slugs[0]);
        $where[]= ['realestate_status','=','published'];
        $where[]= ['cate_type','=',_cateTypeSlug($slugs[0])];
        $array[]=(object) array('where'=>$where,'slug'=>$slugs[0],'key'=>'cateType','_slug'=>_cateTypeSlug($slugs[0]),'url'=>route('web.realestate.all',$slugs[0]),'name'=>$cateTypeName);
        foreach($slugs as $item){
            $cateNameBySlug = cateNameBySlug($slugs[0],$item);
            if($cateNameBySlug){
              $slug[]=$item;
              $where[]= ['cate_slug','=',($item)];
              $array[]=(object) array('where'=>$where,'slug'=>$item,'slug2'=>$slugs[0],'key'=>'category','url'=>route('web.realestate.all',$slug),'name'=>$cateNameBySlug);
            }else{
                $provinceName = provinceNameBySlug($item);
                if($provinceName){
                    $slug[]=$item;
                    $where[]= ['province_slug','=',($item)];
                    $array[]=(object) array('where'=>$where,'slug'=>$item,'key'=>'province','url'=>route('web.realestate.all',$slug),'name'=>$provinceName);
                }else{
                    $districtName  = districtNameBySlug($item);
                    if($districtName){
                        $slug[]=$item;
                        $where[]= ['district_slug','=',($item)];
                        $array[]=(object) array('where'=>$where,'slug'=>$item,'key'=>'district','url'=>route('web.realestate.all',$slug),'name'=>$districtName);
                    }else{
                        $wardName = wardNameBySlug($item);
                        if($wardName){
                            $slug[]=$item;
                            $where[]= ['ward_slug','=',($item)];
                            $array[]=(object) array('where'=>$where,'slug'=>$item,'key'=>'ward','url'=>route('web.realestate.all',$slug),'name'=>$wardName);
                        }else{
                            $realestate_title = realestate_title($item);
                            if($realestate_title){
                                $slug[]=$item;
                                $array[]=(object) array('where'=>$where,'slug'=>$item,'key'=>'realestate','url'=>route('web.realestate.all',$slug),'name'=>$realestate_title);
                            }
                        }
                    }
                }
            }
        }
        return $array;
    }

function getNhaRiengTheoDuong()
{
    $where = array(['cate_slug','=','nha-rieng']);
    if(setting()->provinceID){
        $where = array(['provinceID','=',setting()->provinceID]);
    }
    if(setting()->districtID){
        $where = array(['districtID','=',setting()->districtID]);
    }
    if(setting()->wardID){
        $where = array(['wardID','=',setting()->wardID]);
    }
    return RealestateView::where($where)
    ->orderBy('id','desc')->limit(10)->get();
}
function getBDSTamGia($data)
{
    $where = array(
        ['id','!=',$data->id],
        ['realestate_price','=',$data->realestate_price],
        ['realestate_status','=','published'],
        ['realestate_sold','=','off']
    );
    return RealestateView::where($where)->orderBy('id','desc')->first();
}
function getSilderHome()
{
    return Slider::where('type','=','home')->where('status','=','on')->get();
}
function getSliderUuDai()
{
    return Slider::where('type','=','uudai')->where('status','=','on')->get();
}
function getSliderDangTin()
{
    return Slider::where('type','=','sendBDS')->where('status','=','on')->get();
}
function checkSave($id)
{
    if(Auth::check()){
        $rs = RealestateSaveView::where('save_user_id','=',user()->id)->where('id','=',$id)->count();
        if($rs>0) return 'delete';
        return 'add';
    }else{
        return 'login';
    }

}
function getPagesHeader()
{
    return Posts::where('post_view_type','=','PAGE')->where('post_status','=','published')->where('page_status_header','=','show')->get();
}
function getPagesFooter()
{
    return Posts::where('post_view_type','=','PAGE')->where('post_status','=','published')->where('page_status_footer','=','show')->get();
}
function AntispamStatus()
{
    return true;
}
function getAntispam()
{
    $Antispam = new \stdClass;
    $math = RandomString(1,'+-');
    $numberA = intval(RandomString(1));
    $numberB = intval(RandomString(1));



    $resultAntispam = 0;
    $textMath = "";
    if($math=='+'){
        $textMath = "{$numberA} + {$numberB} = ? ";
        $resultAntispam = ($numberA+$numberB);
        $Antispam->resultAntispam = $resultAntispam;
    }else{
        if($numberA<$numberB){
            $a = $numberB;
            $b = $numberA;
            $numberA = $a;
            $numberB = $b;
        }
        $textMath = "{$numberA} - {$numberB} = ? ";
        $resultAntispam = ($numberA-$numberB);
        $Antispam->resultAntispam = $resultAntispam;
    }
    $Antispam->numberA = $numberA;
    $Antispam->math = $math;
    $Antispam->numberB = $numberB;
    $Antispam->textMath = $textMath;
    return $Antispam;
}

function checkAntispam($request)
{
    if(AntispamStatus()&&(!isset($request->resultMath)&&$request->resultMath=="")){
        return  response()->json(array('status'=>'antispam','icon'=>'success','msg'=>""), 200);
    }
    if($request->resultMath!=$request->resultAntispam){
        return  response()->json(array('status'=>'antispam_check','icon'=>'danger','msg'=>"Kết quả không đúng! Vui lòng thử lại!"), 200);
    }
    return false;
}
