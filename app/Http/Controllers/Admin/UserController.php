<?php

namespace App\Http\Controllers\Admin;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Users\UsersRepository;
use App\Http\Requests\Admin\User\UserAddRequest;
use App\Http\Requests\Admin\User\UserEditRequest;
use App\Models\Users;
class UserController extends Controller
{
    public $UsersRepository;
    public function __construct(UsersRepository $UsersRepository){
        $this->UsersRepository = $UsersRepository;
    }
    public function getList(Request $request)
    {
        $result = $this->UsersRepository->getUserList($request);
        SEOTools::setTitle(setting()->name." - Danh sách thành viên ");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view('admin.pages.user.list',[
            'data'=>$result,
            'q'=>$request->q,
            'type'=>$request->type,
            'role'=>$request->role
        ]);
    }
    public function getAdd(Request $Request)
    {
        SEOTools::setTitle(setting()->name." - Thêm mới");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view('admin.pages.user.action',['user'=>new Users(),'type'=>'insert']);
    }
    public function getEdit(Request $Request)
    {
        SEOTools::setTitle(setting()->name." - Cập nhật");
        SEOTools::opengraph()->setUrl(\URL::current());
        $user = $this->UsersRepository->getUserByID($Request->id);
        if($user){
            return view('admin.pages.user.action',['user'=>$user,'type'=>'update']);
        }

    }
    public function postAdd(UserAddRequest $request)
    {
        $url =route('admin.user.view');
        $result = $this->UsersRepository->addUser($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Thêm thành công " ,'url'=>$url), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Thêm thất bại !" ,'url'=>$url), 200);
        }
    }
    public function postEdit(UserEditRequest $request)
    {
        $url =route('admin.user.view');
        // dd( $request->all());
        $result = $this->UsersRepository->editUser($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật  thành công " ,'url'=>$url), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cập nhật  thất bại !" ,'url'=>$url), 200);
        }
    }
    public function postDelete(Request $request)
    {
        $result = $this->UsersRepository->deleteUser($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Xóa thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Xóa không thành công !"), 200);
        }
    }
    public function postStatus(Request $request)
    {
        $result = $this->UsersRepository->statusUser($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật trạng thái công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cập nhật trạng thái không thành công !"), 200);
        }
    }
}
