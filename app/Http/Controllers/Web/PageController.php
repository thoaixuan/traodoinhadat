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
use App\Http\Requests\Web\Service\phaplyBDSRequest;
use App\Repositories\Contact\ContactRepository;
use App\Repositories\Categorys\CategorysRepository;
use Auth;
class PageController extends Controller
{
    public $CategorysRepository;
    public $PostsRepository;
    public function __construct(CategorysRepository $CategorysRepository,PostsRepository $PostsRepository,ContactRepository $ContactRepository){
        $this->CategorysRepository = $CategorysRepository;
        $this->PostsRepository = $PostsRepository;
        $this->ContactRepository = $ContactRepository;
    }
    public function getAboutIndex(Request $request)
    {
        SEOTools::setTitle("Về chúng tôi");
        return view("web.pages.about.index");
    }
    public function getPrivacyPolicy(Request $request)
    {
        SEOTools::setTitle("Chính sách bảo mật");
        return view("web.pages.privacy-policy.index");
    }
    public function getService(Request $request)
    {
        SEOTools::setTitle("Dịch vụ");
        return view("web.pages.service.index");
    }
    public function getPgae(Request $request)
    {
       $post =  Posts::where('post_slug','=',$request->slug)->where('post_status','=','published')->first();
       if($post)
       {
        SEOTools::setTitle($post->post_title);
        // SEOTools::setDescription($post->post_des);
        // SEOMeta::addKeyword($post->post_keywords);
        SEOTools::opengraph()->setUrl(\URL::current());
        SEOMeta::addMeta('article:published_time', $post->created_at, 'property');
        SEOMeta::addMeta('article:section',$post->cate_name, 'property');
        OpenGraph::addProperty("og:site_name",setting()->name);
        OpenGraph::addProperty('locale','vi');
        $post_image = 'uploads/defaults/_post.jpg';
        $post->img = $post_image;
        OpenGraph::addProperty('image',asset($post->img));
        OpenGraph::addProperty('image:secure_url',asset($post->img));
        OpenGraph::addProperty("twitter:image",asset($post->img));
        $image = getimagesize(public_path($post->img));
        OpenGraph::addProperty("image:width",$image[0]);
        OpenGraph::addProperty("image:height",$image[1]);
        OpenGraph::addProperty('url',url()->current());
        SEOMeta::addMeta('author', $post->full_name);
        OpenGraph::addProperty('article:published_time', $post->created_at);
        OpenGraph::addProperty('article:modified_time', $post->updated_at);
        OpenGraph::addProperty("twitter:site", setting()->name);
        OpenGraph::addProperty("twitter:creator", $post->full_name);
        OpenGraph::addProperty("twitter:title",$post->post_title);
           return view('web.pages.page.index',['data'=>$post]);
       }
       return redirect()->route('web.home.index');
    }
    public function postphaplyBDS(phaplyBDSRequest $request)
    {
        if(checkAntispam($request)){
            return checkAntispam($request);
        }
        $request['body']= json_encode($request->all());
        $result = $this->ContactRepository->sendService($request);
        if($result){
            $this->senMail($request);
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Gửi thành công"), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Gửi không thành công"), 200);
        }
    }
    public function thamdinhBDS(phaplyBDSRequest $request)
    {
        if(checkAntispam($request)){
            return checkAntispam($request);
        }
        $request['body']= json_encode($request->all());
        $result = $this->ContactRepository->sendService($request);
        if($result){
            $this->senMail($request);
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Gửi thành công"), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Gửi không thành công"), 200);
        }
    }
    public function postdambaoTTNN(phaplyBDSRequest $request)
    {
        if(checkAntispam($request)){
            return checkAntispam($request);
        }
        $request['body']= json_encode($request->all());
        $result = $this->ContactRepository->sendService($request);
        if($result){
            $this->senMail($request);
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Gửi thành công"), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Gửi không thành công"), 200);
        }
    }
    public function postthutucvahosoBDS(phaplyBDSRequest $request)
    {
        if(checkAntispam($request)){
            return checkAntispam($request);
        }
        $request['body']= json_encode($request->all());
        $result = $this->ContactRepository->sendService($request);
        if($result){
            $this->senMail($request);
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Gửi thành công"), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Gửi không thành công"), 200);
        }
    }
    public function senMail($request)
    {
        if(setting()->contact_status=='on'){
            configMail();
            $rs =  _sendMail([
                "template"=>"web.pages.contact.service",
                "data"=>[
                    "full_name"=>$request->full_name,
                    "email"=>$request->email,
                    "phone"=>$request->phone,
                ],
                "mailSend"=>[setting()->MAIL_RECEIVE],
                "subject"=>$request->title,
            ]);
        }
    }

}
