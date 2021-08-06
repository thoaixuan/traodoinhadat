<?php
namespace App\Http\Controllers\Web;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Repositories\Posts\PostsRepository;
use App\Http\Requests\Web\Post\PostRequest;
use App\Http\Requests\Web\Post\ActionRequest;
use App\Repositories\Contact\ContactRepository;
use App\Http\Requests\Web\Contact\ContactRequest;
use App\Http\Requests\Web\Contact\LichtuvanRequest;
use Auth;
class ContactController extends Controller
{
    public $ContactRepository;
    public function __construct(ContactRepository $ContactRepository){
        $this->ContactRepository = $ContactRepository;

    }
    public function getContactIndex(Request $request)
    {
        SEOTools::setTitle("Liên hệ");
        return view("web.pages.contact.index");
    }
    public function sendContact(ContactRequest $request)
    {
        if(checkAntispam($request)){
            return checkAntispam($request);
        }
        $result = $this->ContactRepository->sendContact($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Gửi thành công"), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Gửi không thành công"), 200);
        }
    }
    public function datLichTuVan(LichtuvanRequest $request)
    {
        $result = $this->ContactRepository->datLichTuVan($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Gửi thành công"), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Gửi không thành công"), 200);
        }
    }

}
