<?php

namespace App\Http\Controllers\Admin;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contact\ContactRepository;

class ContactController extends Controller
{

    public $ContactRepository;
    public function __construct(
        ContactRepository $ContactRepository
    ){
       $this->ContactRepository = $ContactRepository;
    }
    public function getList(Request $Request)
    {
        SEOTools::setTitle(setting()->name." - Tin nhắn liên hệ");
        SEOTools::opengraph()->setUrl(\URL::current());
        $data =  $this->ContactRepository->getContactList($Request);
        return view('admin.pages.contact.list',['data'=>$data]);
    }
    public function postDelete(Request $request)
    {
        $result = $this->ContactRepository->deleteContact($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Xóa thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Xóa không thành công !"), 200);
        }
    }
    public function postStatus(Request $request)
    {
        $result = $this->ContactRepository->statusContact($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật trạng thái công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cập nhật trạng thái không thành công !"), 200);
        }
    }
}
