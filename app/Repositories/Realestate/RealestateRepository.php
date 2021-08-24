<?php
namespace App\Repositories\Realestate;

use App\Models\Follows;
use App\Repositories\EloquentRepository;
use App\Models\Realestate;
use App\Models\Tags;
use App\Views\RealestateView;
use App\Models\Categorys;
use App\Models\RealestateSave;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Image;
use DOMDocument;
use voku\helper\HtmlDomParser;
class RealestateRepository  extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Realestate::class;
    }
    public function getRealestateList($request)
    {
        $where = array(
            ['realestate_status','=',$request->realestate_status]
        );
        if(isset($request->cate_type)&&!empty($request->cate_type)){
            $where[] = ['cate_type','=',$request->cate_type];
        }
        if(isset($request->category)&&!empty($request->category)){
            $where[] = ['category_id','=',$request->category];
        }
        if(!empty($request->q)){
                $search = $request->q;
                $result =  RealestateView::where($where)
                ->Where(function($query)use($search){
                    $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('full_name', 'LIKE',"%{$search}%")
                    ->orWhere('province_name', 'LIKE',"%{$search}%")
                    ->orWhere('district_name', 'LIKE',"%{$search}%")
                    ->orWhere('ward_name', 'LIKE',"%{$search}%")
                    ->orWhere('cate_name', 'LIKE',"%{$search}%")
                    ->orWhere('realestate_title', 'LIKE',"%{$search}%");
                })
                ->sortable()
                ->orderBy('id','desc')
                ->paginate(10);
                return $result;
        }else{
                $result =  RealestateView::where($where)
                ->sortable()
                ->orderBy('id','desc')
                ->paginate(10);
                return $result;
        }


    }
    public function getListReceived($request)
    {
        $where = array(
            ['realestate_status','=','send']
        );
        if(!empty($request->q)){
                $search = $request->q;
                $result =  RealestateView::where($where)
                ->Where(function($query)use($search){
                    $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('full_name', 'LIKE',"%{$search}%")
                    ->orWhere('province_name', 'LIKE',"%{$search}%")
                    ->orWhere('district_name', 'LIKE',"%{$search}%");
                })
                ->sortable()
                ->orderBy('id','desc')
                ->paginate(10);
                return $result;
        }else{
                $result =  RealestateView::where($where)
                ->sortable()
                ->orderBy('id','desc')
                ->paginate(10);
                return $result;
        }
    }
    public function getRealestateByID($request)
    {
        $result = RealestateView::where('id','=',$request->id)->first();
        if($result){
            $result->arrayImages = array();
            $images =  $this->getImage($result->id);
            if(count($images)){
                $result->arrayImages =$images;
            }
        }
        if($result)return $result ;
        return false;
    }
    public function getImage($id)
    {
        $path  = public_path("/uploads/realestate/realestateID{$id}");
        $files = \File::allFiles($path);
        $images = array();
        foreach($files as $item){
            $images[]=asset("/uploads/realestate/realestateID{$id}/".$item->getFileName());
        }
        return $images;
    }
    public function editData($request)
    {
        $post =  Realestate::where('id','=',$request->id)->first();
        if(!$post)return false;

        $post->category_id = $request->category_id;
        $post->provinceID = $request->provinceID;
        $post->districtID = $request->districtID;
        $post->wardID = $request->wardID;

        $post->cate_type = $request->cate_type;
        $post->realestate_title = $request->realestate_title;
        $post->realestate_slug =$this->getSlug($request,'update');


        $post->realestate_hot = $request->realestate_hot;
        $post->realestate_expertise = $request->realestate_expertise;
        $post->realestate_sold = $request->realestate_sold;

        $post->realestate_status = $request->realestate_status;
        $post->realestate_price = str_replace (",","",$request->realestate_price);
        if($request->cate_type=='cate_lease'&&$request->send_realestate_price_rent!=""){
            $post->send_realestate_price_rent = str_replace (",","",$request->send_realestate_price_rent);
        }
        //Nha
        $post->realestate_nha_huong = $request->realestate_nha_huong;
        $post->realestate_nha_phongngu = $request->realestate_nha_phongngu;
        $post->realestate_nha_phongtam = $request->realestate_nha_phongtam;
        $post->realestate_nha_tan = $request->realestate_nha_tan;
        $post->realestate_nha_giayto = $request->realestate_nha_giayto;
        $post->realestate_nha_chieudai = $request->realestate_nha_chieudai;
        $post->realestate_nha_chieurong = $request->realestate_nha_chieurong;
        $post->realestate_nha_hem = $request->realestate_nha_hem;
        //Dat
        $post->realestate_dat_dientich = $request->realestate_dat_dientich;
        $post->realestate_dat_giayto = $request->realestate_dat_giayto;
        //Mo at
        $post->realestate_tien_ich = $request->realestate_tien_ich;
        $post->realestate_mota = $request->realestate_mota;

        if($post->save()){
            $this->uploadImages($request,'update');
            return true;
        }return false;
    }
    public function addData($request)
    {
        $post = new  Realestate();
        $post->category_id = $request->category_id;
        $post->provinceID = $request->provinceID;
        $post->districtID = $request->districtID;
        $post->wardID = $request->wardID;

        $post->user_id = user()->id;

        $post->cate_type = $request->cate_type;
        $post->realestate_title = $request->realestate_title;
        $post->realestate_slug =$this->getSlug($request,'insert');
        $post->realestate_time = time();
        $post->realestate_status = $request->realestate_status;

        $post->realestate_hot = $request->realestate_hot;
        $post->realestate_expertise = $request->realestate_expertise;
        $post->realestate_sold = $request->realestate_sold;

        $post->realestate_status = $request->realestate_status;
        $post->realestate_price = str_replace (",","",$request->realestate_price);
        if($request->cate_type=='cate_lease'&&$request->send_realestate_price_rent!=""){
            $post->send_realestate_price_rent = str_replace (",","",$request->send_realestate_price_rent);
        }
        //Nha
        $post->realestate_nha_huong = $request->realestate_nha_huong;
        $post->realestate_nha_phongngu = $request->realestate_nha_phongngu;
        $post->realestate_nha_phongtam = $request->realestate_nha_phongtam;
        $post->realestate_nha_tan = $request->realestate_nha_tan;
        $post->realestate_nha_giayto = $request->realestate_nha_giayto;
        $post->realestate_nha_chieudai = $request->realestate_nha_chieudai;
        $post->realestate_nha_chieurong = $request->realestate_nha_chieurong;
        $post->realestate_nha_hem = $request->realestate_nha_hem;
        //Dat
        $post->realestate_dat_dientich = $request->realestate_dat_dientich;
        $post->realestate_dat_giayto = $request->realestate_dat_giayto;
        //Mo at
        $post->realestate_tien_ich = $request->realestate_tien_ich;
        $post->realestate_mota = $request->realestate_mota;

        $post->send_house_number = $request->send_house_number;
        $post->send_house_address = $request->send_house_address;

        $post->save();
        if($post){
            $request['id']= $post->id;
            $request['user_id']= $post->user_id;
            $this->uploadImages($request,'insert');
            return true;
        }return false;
    }
    public function editReceivedData( $request)
    {
        $post =  Realestate::where('id','=',$request->id)->first();
        if(!$post)return false;
        $post->category_id = $request->category_id;
        $post->provinceID = $request->provinceID;
        $post->districtID = $request->districtID;
        $post->wardID = $request->wardID;

        $post->cate_type = $request->cate_type;
        $post->realestate_title = $request->realestate_title;
        $post->realestate_slug =$this->getSlug($request,'update');
        if(!$post->realestate_time){
            $post->realestate_time = time();
        }
        $post->realestate_hot = $request->realestate_hot;
        $post->realestate_expertise = $request->realestate_expertise;
        $post->realestate_sold = $request->realestate_sold;

        $post->realestate_status = $request->realestate_status;
        $post->realestate_price = str_replace (",","",$request->realestate_price);
        if($request->cate_type=='cate_lease'&&$request->send_realestate_price_rent!=""){
            $post->send_realestate_price_rent = str_replace (",","",$request->send_realestate_price_rent);
        }
        //Nha
        $post->realestate_nha_huong = $request->realestate_nha_huong;
        $post->realestate_nha_phongngu = $request->realestate_nha_phongngu;
        $post->realestate_nha_phongtam = $request->realestate_nha_phongtam;
        $post->realestate_nha_tan = $request->realestate_nha_tan;
        $post->realestate_nha_giayto = $request->realestate_nha_giayto;
        $post->realestate_nha_chieudai = $request->realestate_nha_chieudai;
        $post->realestate_nha_chieurong = $request->realestate_nha_chieurong;
        $post->realestate_nha_hem = $request->realestate_nha_hem;
        //Dat
        $post->realestate_dat_dientich = $request->realestate_dat_dientich;
        $post->realestate_dat_giayto = $request->realestate_dat_giayto;
        //Mo at
        $post->realestate_tien_ich = $request->realestate_tien_ich;
        $post->realestate_mota = $request->realestate_mota;

        $post->send_house_number = $request->send_house_number;
        $post->send_house_address = $request->send_house_address;

        if($post->save()){
            $this->uploadImages($request,'update');
            return true;
        }return false;
    }
    public function saveSendData($request)
    {
        $post = new  Realestate();
        $post->cate_type = $request->cate_type;
        $post->user_id = user()->id;
        $post->user_id_send = user()->id;
        $post->provinceID = $request->provinceID;
        $post->districtID = $request->districtID;
        $post->wardID = $request->wardID;

        $post->loai_hinh_thuc_bds = $request->loai_hinh_thuc_bds;
        $post->send_cate_type = $request->cate_type;

        $post->category_id = $request->category_id;
        $post->send_realestate_mota = $request->realestate_mota;
        $post->realestate_mota = $request->realestate_mota;

        $post->send_chinh_chu = $request->chinh_chu;

        $post->send_name_agent = $request->name_agent;
        $post->send_phone_agent = $request->phone_agent;
        $post->send_email_agent = $request->email_agent;

        $post->send_chu_nha_full_name = $request->chu_nha_full_name;
        $post->send_chu_nha_phone = $request->chu_nha_phone;
        $post->send_chu_nha_email = $request->chu_nha_email;

        $post->send_house_number = $request->house_number;
        $post->send_house_address = $request->house_address;
        $post->realestate_price = doubleval(str_replace (",","",$request->realestate_price));
        $post->send_realestate_price = doubleval(str_replace (",","",$request->realestate_price));
        if($request->cate_type=='cate_lease'){
            $post->send_realestate_price_rent = doubleval(str_replace (",","",$request->realestate_price_rent));
        }
        $post->realestate_status = 'send';
        $post->send_realestate_time = time();


        $post->send_nhucau_thamdinh = $request->send_nhucau_thamdinh;
        $post->send_nhucau_cungcapthongtin = $request->send_nhucau_cungcapthongtin;
        $post->send_nhucau_hoangthienhoso = $request->send_nhucau_hoangthienhoso;
        // dd($request->all());
        $post->save();
        if($post){
            $request['id']= $post->id;
            $request['user_id']= $post->user_id;
            $this->uploadImages($request,'insert');
            configMail();
             $rs =  _sendMail([
                    "template"=>"vendor.mail.guitin",
                    "data"=>[
                        "full_name"=>user()->full_name,
                        "email"=>user()->email,
                        'phone'=>user()->phone,
                    ],
                    "mailSend"=>[setting()->MAIL_RECEIVE],
                    "subject"=>"YÊU CẦU GỬI BẤT ĐỘNG SẢN"
                ]);
            return true;
        }return false;
    }
    /*------------------------------Save database trans data--------------------------------------*/
    public function saveTransData($request)
    {
        //dd($request->all()); debugs
        $post = new  Realestate();
        $post->cate_type = "trao_doi";
        $post->user_id = user()->id;
        $post->user_id_send = user()->id;
        $post->provinceID = $request->provinceID;
        $post->districtID = $request->districtID;
        $post->wardID = $request->wardID;
        $post->send_cate_type = $request->cate_type;
        $post->realestate_tien_ich = $request->khoanggiatri;
        $post->realestate_slug = $request->linkpost;/*linkpost */
        $post->category_id = $request->category_id;/*loai bds*/
        $post->send_realestate_mota = $request->realestate_mota;
        $post->realestate_mota = $request->realestate_mota;
        $post->realestate_status = 'send';
        $post->send_realestate_time = time();
        // dd($request->all());
        $post->save();
        if($post){
            $request['id']= $post->id;
            $request['user_id']= $post->user_id;
            configMail();
             $rs =  _sendMail([
                    "template"=>"vendor.mail.guitin",
                    "data"=>[
                        "full_name"=>user()->full_name,
                        "email"=>user()->email,
                        'phone'=>user()->phone,
                    ],
                    "mailSend"=>[setting()->MAIL_RECEIVE],
                    "subject"=>"YÊU CẦU TRAO ĐỔI BẤT ĐỘNG SẢN"
                ]);
            return true;
        }return false;
    }
    /* ---------------------------------------------------------------------------------------------------------- */
    public function saveRealestate($request)
    {
        if($request->status=='add'){
           $rs = new RealestateSave();
           $rs->realestate_id = $request->id;
           $rs->user_id = user()->id;
           if($rs->save()) return true;
           return false;
        }else{
            $rs = RealestateSave::where('realestate_id','=',$request->id)->where('user_id','=',user()->id)->first();
            // dd($rs);
            if($rs->delete()) return true;
            return false;
        }
    }
    public function uploadImages($request,$type)
    {
        $postID = $request->id;
        $FOLDER  = "/uploads/realestate/realestateID{$postID}";
        if($type=='insert'){
            \File::makeDirectory(public_path($FOLDER));
        }
        $arrayImage = array();
        $images =  $request->file_realestate_image;
        $rowImage = array();
        foreach($images as $src){
            if(preg_match('/data:image/', $src)){
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $filename = uniqid().$postID;
                $filepath = "{$FOLDER}/$filename.$mimetype";
                Image::make($src)
                  ->encode($mimetype, 100)
                  ->save(public_path($filepath));
                $rowImage[]=['url'=>$filepath];
                $rowImage[]=['name'=>$filename.".".$mimetype];
                $arrayImage[] = $filename.".".$mimetype;
            }else{
                if($src!=""){
                    $src = explode("/",$src);
                    $srcIndex = count($src);
                    $arrayImage[]=$src[$srcIndex-1];
                }
            }
        }
        $this->removeFileImage($FOLDER,collect($arrayImage));
    }
    public function removeFileImage($FOLDER,$arrayImage)
    {
        $path = public_path($FOLDER);
        $files = \File::allFiles($path);
        foreach($files as $item){
            if($arrayImage->contains($item->getFileName())==false){
                \File::delete($item->getPathname());
            }
        }
    }
    public function getSlug($request,$type)
    {
        if($type=='update'){
            $count = Realestate::where('realestate_slug','=',to_slug($request->realestate_title))->where('id','!=',$request->id)->count();
            if($count>0) return SlugService::createSlug(Realestate::class, 'realestate_slug', $request->realestate_title,['unique' => true]);
            return false;
        }else{
            return SlugService::createSlug(Realestate::class, 'realestate_slug', $request->realestate_title,['unique' => true]);
        }
    }
    // Đang tính phát triển
    public function senEmailSubscribe()
    {
        # code...
    }
}
