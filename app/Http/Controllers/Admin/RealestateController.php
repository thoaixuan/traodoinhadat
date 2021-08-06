<?php

namespace App\Http\Controllers\Admin;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Realestate;
use App\Repositories\Realestate\RealestateRepository;
use App\Http\Requests\Admin\Realestate\RealestateRequest;
use App\Http\Requests\Admin\Realestate\RealestateReceivedRequest;
use App\Repositories\Categorys\CategorysRepository;
use Auth;
class RealestateController extends Controller
{
    public $CategorysRepository;
    public $RealestateRepository;
    public function __construct(CategorysRepository $CategorysRepository,RealestateRepository $RealestateRepository){
        $this->CategorysRepository = $CategorysRepository;
        $this->RealestateRepository = $RealestateRepository;
    }
    public function getList(Request $request)
    {
        if($request->type==""){
            $request['realestate_status'] = 'published';
        }else{
            $request['realestate_status'] = $request->type;
        }
        $realestate = $this->RealestateRepository->getRealestateList($request);
        SEOTools::setTitle(user()->full_name." - Xem danh sách");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("admin.pages.realestate.list",[
            'realestate_status'=>$request->realestate_status,
            'data'=>$realestate,
            'search'=>$request->q,
            'cate_type'=>$request->cate_type,
            'category'=>$request->category
        ]);
    }
    public function getListReceived(Request $request)
    {

        $realestate = $this->RealestateRepository->getListReceived($request);
        SEOTools::setTitle(user()->full_name." - Tin đã nhận");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("admin.pages.realestate.received",[
            'data'=>$realestate,
            'search'=>$request->q,
        ]);
    }
    public function getAdd(Request $request)
    {
        if($request->session()->get('url')==null){
        $request->session()->put('url', url()->previous());}
        SEOTools::setTitle(Auth::user()->full_name." - Đăng tin");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("admin.pages.realestate.action",['realestate'=>new Realestate(),'type'=>'insert']);
    }
    public function getEdit(Request $request){
        if($request->session()->get('url')==null){
            $request->session()->put('url', url()->previous());
        }
        $realestate = $this->RealestateRepository->getRealestateByID($request);
        if($realestate){
            SEOTools::setTitle("Cập nhật - ".$realestate->realestate_title);
            SEOTools::opengraph()->setUrl(\URL::current());
            return view("admin.pages.realestate.action",['realestate'=>$realestate,'type'=>'update']);
        }else{
        }
    }
    public function Edit(RealestateRequest $request)
    {
        $result = $this->RealestateRepository->editData($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật thành công " ,'url'=>route('admin.realestate.view')), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cập nhật thất bại !" ,'url'=>route('admin.realestate.view')), 200);
        }
    }
    public function Add(RealestateRequest $request)
    {
        $result = $this->RealestateRepository->addData($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật thành công " ,'url'=>route('admin.realestate.view')), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cập nhật thất bại !" ,'url'=>route('admin.realestate.view')), 200);
        }
    }
    public function editReceived(RealestateReceivedRequest $request)
    {
        // dd($request->all());
        $result = $this->RealestateRepository->editReceivedData($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật thành công " ,'url'=>route('admin.realestate.view')), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cập nhật thất bại !" ,'url'=>route('admin.realestate.view')), 200);
        }
    }

    public function Delete(Request $request)
    {
        $result = $this->RealestateRepository->delete(intval($request->id));
        if($result){
            $FOLDER  = "/uploads/realestate/realestateID{$request->id}";
            \File::deleteDirectory(public_path($FOLDER));
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Xóa thành công"), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Xóa không thành công !"), 200);
        }
    }

}
