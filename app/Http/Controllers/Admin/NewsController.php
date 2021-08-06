<?php


namespace App\Http\Controllers\Admin;

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
use App\Repositories\Categorys\CategorysRepository;
use Auth;
class NewsController extends Controller
{
    public $CategorysRepository;
    public $PostsRepository;
    public function __construct(CategorysRepository $CategorysRepository,PostsRepository $PostsRepository){
        $this->CategorysRepository = $CategorysRepository;
        $this->PostsRepository = $PostsRepository;
    }
    public function getNewsList(Request $request)
    {

        if($request->type==""){
            $request['post_status'] = 'published';
        }else{
            $request['post_status'] = $request->type;
        }

        $posts = $this->PostsRepository->getPostList($request);
        // dd($posts);
        SEOTools::setTitle(user()->full_name." - Bài viết công khai");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("admin.pages.post.list",[
            'post_status'=>$request->post_status,
            'data'=>$posts,
            'search'=>$request->q,
            'category'=>$request->c
        ]);
    }
    public function getAdd(Request $request)
    {
        if($request->session()->get('url')==null){
            $request->session()->put('url', url()->previous());
        }
        SEOTools::setTitle(Auth::user()->full_name." - Viết bài");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("admin.pages.post.action",['post'=>new Posts(),'type'=>'insert']);
    }
    public function getEdit(Request $request){
        if($request->session()->get('url')==null){
            $request->session()->put('url', url()->previous());
        }
        $post = $this->PostsRepository->getPostByID($request);
        if($post){
            SEOTools::setTitle("Cập nhật - ".$post->post_title);
            SEOTools::opengraph()->setUrl(\URL::current());
            return view("admin.pages.post.action",['post'=>$post,'type'=>'update']);
        }else{
            return view("admin.pages.publish.nodata");
        }

    }
    public function newsEdit(PostRequest $request)
    {
        $url = $request->session()->get('url');
        $result = $this->PostsRepository->updatePost($request);
        if($result){
            $request->session()->put('url', null);
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật bài viết thành công " ,'url'=>$url), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cập nhật bài viết thất bại !" ,'url'=>$url), 200);
        }
    }
    public function newsAdd(PostRequest $request)
    {
        $url = $request->session()->get('url');
        $result = $this->PostsRepository->insertPost($request);
        if($result){
            $request->session()->put('url',null);
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Viết bài thành công " ,'url'=>$url), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Viết bài thất bại !" ,'url'=>$url), 200);
        }
    }
    public function newsDelete(ActionRequest $request)
    {
        $result = $this->PostsRepository->delete(intval($request->id));
        if($result){
            $FOLDER  = "/uploads/posts/postID{$request->id}";
            \File::deleteDirectory(public_path($FOLDER));
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Xóa thành công"), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Xóa không thành công !"), 200);
        }
    }
    public function postStatusHot(Request $request)
    {
        $result = $this->PostsRepository->postStatusHot($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật trạng thái công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cập nhật trạng thái không thành công !"), 200);
        }
    }
}
