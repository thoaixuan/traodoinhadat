<?php
namespace App\Http\Controllers\Admin;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Subscribe\SubscribeRepository;

class SubscribeController extends Controller
{

    public $SubscribeRepository;
    public function __construct(
        SubscribeRepository $SubscribeRepository
    ){
       $this->SubscribeRepository = $SubscribeRepository;
    }
    public function getList(Request $Request)
    {
        SEOTools::setTitle(setting()->name." - Bình luận ");
        SEOTools::opengraph()->setUrl(\URL::current());
        $data =  $this->SubscribeRepository->getSubscribeList($Request);
        return view('admin.pages.subscribe.list',['data'=>$data]);
    }
    public function postDelete(Request $request)
    {
        $result = $this->SubscribeRepository->deleteSubscribe($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Xóa thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Xóa không thành công !"), 200);
        }
    }
}
