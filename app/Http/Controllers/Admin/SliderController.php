<?php

namespace App\Http\Controllers\Admin;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Slider\SliderRepository;
use App\Models\Slider;
use App\Http\Requests\Admin\Slider\sliderRequest;
class SliderController extends Controller
{

    public $SliderRepository;
    public function __construct(
        SliderRepository $SliderRepository
    ){
       $this->SliderRepository = $SliderRepository;
    }
    public function getList(Request $Request)
    {
        SEOTools::setTitle("Danh sách Slider - ".setting()->name);
        SEOTools::opengraph()->setUrl(\URL::current());
        $data =  $this->SliderRepository->getSliderList($Request);
        return view('admin.pages.slider.list',['data'=>$data]);
    }
    public function getEdit(Request $request)
    {
        SEOTools::setTitle("Cập nhật slider - ".setting()->name);
        SEOTools::opengraph()->setUrl(\URL::current());
        $data = Slider::where('id','=',$request->id)->where('type','=',$request->type)->first();
        if($data){
            return view('admin.pages.slider.action',['action'=>'update','data'=>$data]);
        }
    }
    public function postEdit(sliderRequest $request)
    {
        $result = $this->SliderRepository->editSlider($request);
        if($result){
            $url = route('admin.slider.view')."?type=".$request->type;
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật thành công ",'url'=>$url), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cập nhật không thành công !"), 200);
        }
    }
    public function getAdd(Request $request)
    {
        SEOTools::setTitle("Thêm slider - ".setting()->name);
        SEOTools::opengraph()->setUrl(\URL::current());
        if(isset($request->type)){
            return view('admin.pages.slider.action',['action'=>'insert','data'=>new Slider()]);
        }
    }
    public function postAdd(sliderRequest $request)
    {
        $result = $this->SliderRepository->addSlider($request);
        if($result){
            $url = route('admin.slider.view')."?type=".$request->type;
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Thêm thành công ",'url'=>$url), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Thêm không thành công !"), 200);
        }
    }
    public function postDelete(Request $request)
    {
        $result = $this->SliderRepository->deleteSlider($request);

        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Xóa thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Xóa không thành công !"), 200);
        }
    }
    public function postStatus(Request $request)
    {
        $result = $this->SliderRepository->statusSlider($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật trạng thái công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cập nhật trạng thái không thành công !"), 200);
        }
    }
}
