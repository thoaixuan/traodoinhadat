<?php

namespace App\Http\Controllers\Admin;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Pages\PagesRepository;
use App\Http\Requests\Admin\Page\PageRequest;
use App\Http\Requests\Admin\Category\SubRequest;
use App\Models\Posts;

class PageController extends Controller
{

    public $PagesRepository;
    public function __construct(PagesRepository $PagesRepository){
        $this->PagesRepository = $PagesRepository;
    }
    public function getList(Request $Request)
    {
        SEOTools::setTitle(setting()->name." - Danh sách trang");
        SEOTools::opengraph()->setUrl(\URL::current());
        $result =$this->PagesRepository->getPageList($Request);
        return view('admin.pages.page.list',['data'=>$result]);
    }
    public function getAdd(Request $Request)
    {
        SEOTools::setTitle(setting()->name." - Thêm mới");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view('admin.pages.page.action',['post'=>new Posts(),'type'=>'insert']);
    }
    public function getEdit(Request $Request)
    {
        SEOTools::setTitle(setting()->name." - Cập nhật");
        SEOTools::opengraph()->setUrl(\URL::current());
        $page = $this->PagesRepository->getPageByID($Request);
        if($page){
            return view('admin.pages.page.action',['post'=>$page,'type'=>'update']);
        }

    }
    public function postAdd(PageRequest $request)
    {
        $url =route('admin.page.view');
        $result = $this->PagesRepository->addPage($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Thêm trang thành công " ,'url'=>$url), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Thêm trang thất bại !" ,'url'=>$url), 200);
        }
    }
    public function postEdit(PageRequest $request)
    {
        $url =route('admin.page.view');
        $result = $this->PagesRepository->editPage($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật trang thành công " ,'url'=>$url), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cập nhật trang thất bại !" ,'url'=>$url), 200);
        }
    }
    public function postDelete(Request $request)
    {
        $result = $this->PagesRepository->deletePage($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Xóa thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Xóa không thành công !"), 200);
        }
    }
    public function postStatus(Request $request)
    {
        $result = $this->PagesRepository->statusPage($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật trạng thái công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cập nhật trạng thái không thành công !"), 200);
        }
    }
}
