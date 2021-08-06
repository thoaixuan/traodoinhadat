<?php

namespace App\Http\Controllers\Admin;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\Categorys\CategorysRepository;

use App\Http\Requests\Admin\Category\ParentRequest;
use App\Http\Requests\Admin\Category\SubRequest;

class CategoryController extends Controller
{

    public $CategorysRepository;
    public function __construct(
        CategorysRepository $CategorysRepository
    ){
       $this->CategorysRepository = $CategorysRepository;
    }
    public function getParentCategpry(Request $request)
    {
        SEOTools::setTitle(setting()->name." - Danh mục cha");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("admin.pages.category.parent-category");
    }
    public function getSubCategory(Request $request)
    {
        SEOTools::setTitle(setting()->name." - Danh mục con");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("admin.pages.category.sub-categpry");
    }
    public function getParentDatatable(Request $request)
    {
        $result= $this->CategorysRepository->getParentDatatable($request);
        return json_encode($result);
    }
    public function getSubDatatable(Request $request)
    {
        $result= $this->CategorysRepository->getSubDatatable($request);
        return json_encode($result);
    }
    // Parent
    public function getParentEdit(Request $request)
    {
        $result= $this->CategorysRepository->getCategoryByID($request);
        return json_encode($result);
    }
    public function postParentEdit(ParentRequest $request)
    {
        $result= $this->CategorysRepository->editParentCategory($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cập nhật thất bại !" ), 200);
        }

    }
    public function postParentAdd(ParentRequest $request)
    {
        $result= $this->CategorysRepository->addParentCategory($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Thêm thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Thêm thất bại !" ), 200);
        }

    }
    public function postParentDelete(Request $request)
    {
        $result= $this->CategorysRepository->deleteCategory($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Xóa thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Xóa thất bại !" ), 200);
        }
    }
    // Sub
    public function getSubEdit(Request $request)
    {
        $result= $this->CategorysRepository->getCategoryByID($request);
        return json_encode($result);
    }
    public function postSubEdit(SubRequest $request)
    {
        $result= $this->CategorysRepository->editSubCategory($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cập nhật thất bại !" ), 200);
        }

    }
    public function postSubAdd(SubRequest $request)
    {
        $result= $this->CategorysRepository->addSubCategory($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Thêm thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Thêm thất bại !" ), 200);
        }

    }
    public function postSubDelete(Request $request)
    {
        $result= $this->CategorysRepository->deleteCategory($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Xóa thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Xóa thất bại !" ), 200);
        }
    }
}
