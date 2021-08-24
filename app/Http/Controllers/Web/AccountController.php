<?php

namespace App\Http\Controllers\Web;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Users\UsersRepository;
use App\Repositories\Posts\PostsRepository;
use App\Http\Requests\Web\Profile\ProfileRequest;
use App\Http\Requests\Web\Profile\ChangePassRequest;
use App\Models\Users;
use App\Models\Realestate;
use App\Views\RealestateView;
use App\Views\RealestateSaveView;
use App\Models\RealestateSave;
class AccountController extends Controller
{
    public $UsersRepository;
    public function __construct(UsersRepository $UsersRepository){
        $this->UsersRepository = $UsersRepository;
    }
    public function getIndex(Request $request)
    {
        SEOTools::setTitle("Tài khoản - Hồ sơ");
        return view("web.pages.account.hoso",['type'=>'hoso']);
    }
    public function getTinDaGui(Request $request)
    {
        SEOTools::setTitle("Tài khoản - Tin đã gửi (".countRealestateSendWeb().")");
        $data = $this->runTinDaGui($request);
        $cate_type = $request->cate_type;
        $q = $request->q;
        return view("web.pages.account.tindagui",[
            'type'=>'tindagui',
            'cate_type'=> $cate_type,
            'q'=> $q,
            'data'=> $data
        ]);
    }
    //Tin trao doi
    public function getTinTraoDoi(Request $request)
    {
        SEOTools::setTitle("Tài khoản - Tin trao đổi");
        $data = $this->runTinTraoDoi($request);
        $cate_type = "trao_doi";
        $q = $request->q;
        return view("web.pages.account.tintraodoi",[
            'type'=>'tintraodoi',
            'cate_type'=> $cate_type,
            'q'=> $q,
            'data'=> $data
        ]);
    } 
    public function getTinDaDuyet(Request $request)
    {
        $countSave = countRealestatePublicWeb();
        SEOTools::setTitle("Tài khoản - Tin đã duyệt ({$countSave })");
        $data = $this->runTinDaDuyet($request);
        $cate_type = $request->cate_type;
        $q = $request->q;
        return view("web.pages.account.tindaduyet",[
            'type'=>'tindaduyet',
            'cate_type'=> $cate_type,
            'q'=> $q,
            'data'=> $data
        ]);
    }
    public function getTinDaLuu(Request $request)
    {
        $countSave = countRealestateSave();
        SEOTools::setTitle("Tài khoản - Tin đã lưu ({$countSave})");
        $data = $this->runTinDaLuu($request);
        $cate_type = $request->cate_type;
        $q = $request->q;
        return view("web.pages.account.tindaluu",[
            'type'=>'tindaluu',
            'cate_type'=> $cate_type,
            'q'=> $q,
            'data'=> $data
        ]);
    }
    public function getDoiMatKhau(Request $request)
    {
        SEOTools::setTitle("Tài khoản - Đỗi mật khẩu");
        return view("web.pages.account.doimatkhau",['type'=>'doimatkhau']);
    }
    public function getLienHe(Request $request)
    {
        SEOTools::setTitle("Tài khoản - Liên hệ Admin");
        return view("web.pages.account.lienhe",['type'=>'lienhe']);
    }

    public function postUpdateProfile (ProfileRequest $request)
    {
        $result = $this->UsersRepository->updateProfile($request);
        $url = route('web.account.hoso');
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật thành công",'url'=>$url), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'error','msg'=>"Cập nhật thất bại ! "), 200);
        }
    }
    public function postChangePassword(ChangePassRequest $request)
    {
        if (\Hash::check($request->old_password, \Auth::user()->password)) {
            $result =  $this->UsersRepository->updatePassword($request);
            if($result){
                return response()->json(array(
                    "status"=>'success',
                    "msg"=>"Cập nhật thành công "
                ), 200);
            }else{
                return response()->json(array(
                    "status"=>'error',
                    "msg"=>"Cập nhật thất bại"
                ), 200);
            }
        } else {
            return response()->json(array(
                "status"=>'error',
                "msg"=>"Mật khẩu cũ không hợp lệ !"
            ), 200);
        }
    }
    public function runTinDaGui(Request $request)
    {
        $search = $request->input('q');
        $cate_type = $request->input('cate_type');
        $where = array(
            ['id','!=',null],
            ['user_id_send','=',user()->id]
        );
        if($cate_type!=""){
            $where[]=['cate_type','=', $cate_type];
        }
        if(empty($search)){
            $RealestateView =RealestateView::where($where)->sortable()
            ->orderBy('id','desc')
            ->paginate(10);
            $RealestateView->withPath(\URL::current()."?q=$request->q&cate_type=$request->cate_type");
            return $RealestateView;
        }else{
            $RealestateView =RealestateView::where($where)->Where(function($query)use($search){
                $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('full_name', 'LIKE',"%{$search}%")
                ->orWhere('province_name', 'LIKE',"%{$search}%")
                ->orWhere('district_name', 'LIKE',"%{$search}%")
                ->orWhere('ward_name', 'LIKE',"%{$search}%")
                ->orWhere('cate_name', 'LIKE',"%{$search}%")
                ->orWhere('send_house_number', 'LIKE',"%{$search}%")
                ->orWhere('send_house_address', 'LIKE',"%{$search}%")
                ->orWhere('created_at', 'LIKE',"%{$search}%")
                ;
            })
            ->sortable()
            ->orderBy('id','desc')
            ->paginate(10);
            $RealestateView->withPath(\URL::current()."?q=$request->q&cate_type=$request->cate_type");
            return $RealestateView;
        }
    }
    //run tin trao doi
    public function runTinTraoDoi(Request $request)
    {
        $search = $request->input('q');
        $cate_type = "trao_doi";
        $where = array(
            ['id','!=',null],
            ['user_id_send','=',user()->id]
        );
        if($cate_type!=""){
            $where[]=['cate_type','=', $cate_type];
        }
        if(empty($search)){
            $RealestateView =RealestateView::where($where)->sortable()
            ->orderBy('user_id','desc')
            ->paginate(10);
            $RealestateView->withPath(\URL::current()."?q=$request->q&cate_type=$request->cate_type");
            return $RealestateView;
        }else{
            $RealestateView =RealestateView::where($where)->Where(function($query)use($search){
                $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('full_name', 'LIKE',"%{$search}%")
                ->orWhere('province_name', 'LIKE',"%{$search}%")
                ->orWhere('district_name', 'LIKE',"%{$search}%")
                ->orWhere('ward_name', 'LIKE',"%{$search}%")
                ->orWhere('cate_name', 'LIKE',"%{$search}%")
                ->orWhere('send_house_number', 'LIKE',"%{$search}%")
                ->orWhere('send_house_address', 'LIKE',"%{$search}%")
                ->orWhere('created_at', 'LIKE',"%{$search}%")
                ;
            })
            ->sortable()
            ->orderBy('id','desc')
            ->paginate(10);
            $RealestateView->withPath(\URL::current()."?q=$request->q&cate_type=$request->cate_type");
            return $RealestateView;
        }
    }
    public function runTinDaDuyet(Request $request)
    {
        $search = $request->input('q');
        $cate_type = $request->input('cate_type');
        $where = array(
            ['id','!=',null],
            ['user_id_send','=',user()->id],
            ['realestate_status','=','published']
        );
        if($cate_type!=""){
            $where[]=['cate_type','=', $cate_type];
        }
        if(empty($search)){
            $RealestateView =RealestateView::where($where)->sortable()
            ->orderBy('id','desc')
            ->paginate(10);
            $RealestateView->withPath(\URL::current()."?q=$request->q&cate_type=$request->cate_type");
            return $RealestateView;
        }else{
            $RealestateView =RealestateView::where($where)->Where(function($query)use($search){
                $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('full_name', 'LIKE',"%{$search}%")
                ->orWhere('province_name', 'LIKE',"%{$search}%")
                ->orWhere('district_name', 'LIKE',"%{$search}%")
                ->orWhere('ward_name', 'LIKE',"%{$search}%")
                ->orWhere('cate_name', 'LIKE',"%{$search}%")
                ->orWhere('send_house_number', 'LIKE',"%{$search}%")
                ->orWhere('send_house_address', 'LIKE',"%{$search}%")
                ->orWhere('created_at', 'LIKE',"%{$search}%")
                ;
            })
            ->sortable()
            ->orderBy('id','desc')
            ->paginate(10);
            $RealestateView->withPath(\URL::current()."?q=$request->q&cate_type=$request->cate_type");
            return $RealestateView;
        }
    }
    public function runTinDaLuu(Request $request)
    {
        $search = $request->input('q');
        $cate_type = $request->input('cate_type');
        $where = array(
            ['save_user_id','=',user()->id],
        );
        if($cate_type!=""){
            $where[]=['cate_type','=', $cate_type];
        }
        if(empty($search)){
            $RealestateView =RealestateSaveView::where($where)->sortable()
            ->orderBy('id','desc')
            ->paginate(10);
            $RealestateView->withPath(\URL::current()."?q=$request->q&cate_type=$request->cate_type");
            return $RealestateView;
        }else{
            $RealestateView =RealestateSaveView::where($where)->Where(function($query)use($search){
                $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('full_name', 'LIKE',"%{$search}%")
                ->orWhere('province_name', 'LIKE',"%{$search}%")
                ->orWhere('district_name', 'LIKE',"%{$search}%")
                ->orWhere('ward_name', 'LIKE',"%{$search}%")
                ->orWhere('cate_name', 'LIKE',"%{$search}%")
                ->orWhere('send_house_number', 'LIKE',"%{$search}%")
                ->orWhere('send_house_address', 'LIKE',"%{$search}%")
                ->orWhere('created_at', 'LIKE',"%{$search}%")
                ;
            })
            ->sortable()
            ->orderBy('id','desc')
            ->paginate(10);
            $RealestateView->withPath(\URL::current()."?q=$request->q&cate_type=$request->cate_type");
            return $RealestateView;
        }
    }
    public function deleteTinDaGui(Request $request)
    {
        $Realestate = Realestate::where('realestate_status','=','send')->where('user_id_send','=',user()->id)->where('id','=',$request->id)->first();
        if($Realestate){
            $Realestate->delete();
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Xóa thành công"), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'error','msg'=>"Tin của bạn đã được duyệt không thể xóa <br> vui lòng liên hệ với admin "), 200);
        }
    }
    public function deleteTinDaLuu(Request $request)
    {
        $Realestate = RealestateSave::where('user_id','=',user()->id)->where('realestate_id','=',$request->id)->first();
        if($Realestate){
            $Realestate->delete();
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Xóa thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'error','msg'=>"Xóa không thành công ! "), 200);
        }
    }
    //X
    public function deleteTinTraoDoi(Request $request)
    {
        $Realestate = Realestate::where('user_id','=',user()->id)->where('id','=',$request->id)->first();
        if($Realestate){
            $Realestate->delete();
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Xóa thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'error','msg'=>"Xóa không thành công ! "), 200);
        }
    }
}
