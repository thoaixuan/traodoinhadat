<?php

namespace App\Http\Controllers\Admin;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Roles\RolesRepository;
use App\Http\Requests\Admin\Role\RoleAddRequest;
use App\Http\Requests\Admin\Role\RoleEditRequest;
use App\Models\Roles;
class RoleController extends Controller
{
    public $RolesRepository;
    public function __construct(RolesRepository $RolesRepository){
        $this->RolesRepository = $RolesRepository;
    }
    public function getList(Request $request)
    {
        $result = $this->RolesRepository->getRoleList($request);
        SEOTools::setTitle(setting()->name." - Danh sách quyền ");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view('admin.pages.role.list',[
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
        return view('admin.pages.role.action',['role'=>new Roles(),'type'=>'insert']);
    }
    public function getEdit(Request $Request)
    {
        SEOTools::setTitle(setting()->name." - Cập nhật");
        SEOTools::opengraph()->setUrl(\URL::current());
        $role = $this->RolesRepository->getRoleByID($Request->id);
        if($role){
            return view('admin.pages.role.action',['role'=>$role,'type'=>'update']);
        }

    }
    public function postAdd(RoleAddRequest $request)
    {
        $url =route('admin.role.view');
        $result = $this->RolesRepository->addRole($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Thêm thành công " ,'url'=>$url), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Thêm thất bại !" ,'url'=>$url), 200);
        }
    }
    public function postEdit(RoleEditRequest $request)
    {
        $url =route('admin.role.view');
        $result = $this->RolesRepository->editRole($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật  thành công " ,'url'=>$url), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cập nhật  thất bại !" ,'url'=>$url), 200);
        }
    }
    public function postDelete(Request $request)
    {
        $result = $this->RolesRepository->deleteRole($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Xóa thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Xóa không thành công !"), 200);
        }
    }
}
