<?php

namespace App\Http\Controllers\Web;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Models\Subscribe;
use App\Http\Controllers\Controller;
use App\Repositories\Categorys\CategorysRepository;
use App\Repositories\Posts\PostsRepository;
use App\Http\Requests\Web\Home\subscribeRequest;
class HomeController extends Controller
{

    public $PostsRepository;
    public function __construct(PostsRepository $PostsRepository){
        $this->PostsRepository = $PostsRepository;
    }
    public function index(Request $request)
    {
        SEOTools::setTitle(setting()->title);
        SEOTools::setDescription(setting()->des);
        SEOMeta::addKeyword(setting()->keywords);
        SEOTools::opengraph()->setUrl(\URL::current());
        SEOMeta::addMeta('article:published_time', setting()->created_at, 'property');
        SEOMeta::addMeta('article:section',setting()->name, 'property');
        OpenGraph::addProperty("og:site_name",setting()->name);
        OpenGraph::addProperty('locale','vi');
        if ( file_exists(public_path(setting()->seoImage))&&setting()->seoImage!=""){
            $img =   "/themes/admin/uploads/defaults/logo_ing_fm.jpg";//setting()->logo;
        }else{
            $img = "/themes/admin/uploads/defaults/logo_ing_fm.jpg";
        }
        OpenGraph::addProperty('image',asset($img));
        OpenGraph::addProperty('image:secure_url',asset($img));
        OpenGraph::addProperty("twitter:image",asset($img));
        $image = getimagesize(public_path($img));
        OpenGraph::addProperty("image:width",$image[0]);
        OpenGraph::addProperty("image:height",$image[1]);
        OpenGraph::addProperty('url',url()->current());
        OpenGraph::addProperty('article:published_time', setting()->created_at);
        OpenGraph::addProperty('article:modified_time', setting()->updated_at);
        OpenGraph::addProperty("twitter:site", setting()->name);
        OpenGraph::addProperty("twitter:title",setting()->name);
        return view('web.pages.home.index');
    }
    public function subscribe(subscribeRequest $request)
    {
        if(checkAntispam($request)){
            return checkAntispam($request);
        }
        $sb = new Subscribe();
        $sb->email = $request->email;
        if($sb->save()){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Đăng ký thành công"), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Đăng ký không thành công"), 200);
        }
    }
}
