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
use App\Views\PostsView;
use App\Repositories\Posts\PostsRepository;
use App\Http\Requests\Web\Post\PostRequest;
use App\Http\Requests\Web\Post\ActionRequest;
use App\Repositories\Categorys\CategorysRepository;
use Auth;
use PhpParser\Node\Expr\PostInc;

class NewsController extends Controller
{
    public $CategorysRepository;
    public $PostsRepository;
    public function __construct(CategorysRepository $CategorysRepository,PostsRepository $PostsRepository){
        $this->CategorysRepository = $CategorysRepository;
        $this->PostsRepository = $PostsRepository;
    }
    public function getSearch(Request $request)
    {
        $posts = $this->PostsRepository->getSearchPost($request);
        if($request->q!=""){
            SEOTools::setTitle("Tìm kiếm - ".$request->q);
        }else{
            SEOTools::setTitle("Tìm kiếm ");
        }
        SEOTools::setDescription(setting()->des);
        return view('web.pages.news.pages.search.index',['qSearch'=>$request->q,'posts'=>$posts]);
    }
    public function getNewsIndex(Request $request)
    {
        SEOTools::setTitle("Tin tức bất động sản");
        SEOTools::setDescription(setting()->des);
        SEOMeta::addKeyword(setting()->keywords);
        SEOTools::opengraph()->setUrl(\URL::current());
        SEOMeta::addMeta('article:published_time', setting()->created_at, 'property');
        SEOMeta::addMeta('article:section',setting()->name, 'property');
        OpenGraph::addProperty("og:site_name",setting()->name);
        OpenGraph::addProperty('locale','vi');
        if ( file_exists(public_path(setting()->seoImage))&&setting()->seoImage!=""){
            $img = setting()->seoImage;
        }else{
            $img = "/uploads/defaults/home.png";
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
        $posts = $this->PostsRepository->getPostPageHome($request);
        return view("web.pages.news.pages.news.index",['posts'=>$posts]);
    }
    public function getPost(Request $request)
    {
        $cate =  $this->CategorysRepository->getInfoCatgoryBySlug($request->slug1,$request->slug2);

        $page = null;
        $post = null;
        if($request->slug1!=null&&$request->slug2!=null&&$request->slug3!=null){
            $post =  $this->getPostSingleBySlug($request->slug3);
            if($post){
                return $this->viewSingle($post);
            }else{
                return  $this->viewDefault();
            }
        }else{
            $post =  $this->getPostSingleBySlug($request->slug1);
            if($post){
                return $this->viewSingle($post);
            }
        }

        if($cate){
            $posts = $this->getPostByCategory($cate);
            // dd( $cate);
            return $this->viewCategory($posts,$cate);
        }else{
            if($request->slug1!=null&&$request->slug2!=null&&$request->slug3!=null){
                $post = $this->getPostSingleBySlug($request->slug3);
            }else if($request->slug1!=null&&$request->slug2!=null&&$request->slug3==null){
                $post = $this->getPostSingleBySlug($request->slug2);
            }else if($request->slug1!=null&&$request->slug2==null&&$request->slug3==null){
                $post = $this->getPostSingleBySlug($request->slug1);
                if($post==null){
                    $page = $this->getPageSingleBySlug($request->slug1);
                }
            }
            if($post){
               return $this->viewSingle($post);
            }
            else{
                return  $this->viewDefault();
            }
        }
    }
    public function viewDefault()
    {

        return redirect()->route('web.news.news');
    }
    public function viewSingle($post)
    {
        SEOTools::setTitle($post->post_title.'-'.$post->cate_name);
        // SEOTools::setDescription($post->post_des);
        // SEOMeta::addKeyword($post->post_keywords);
        SEOTools::opengraph()->setUrl(\URL::current());
        SEOMeta::addMeta('article:published_time', $post->created_at, 'property');
        SEOMeta::addMeta('article:section',$post->cate_name, 'property');
        OpenGraph::addProperty("og:site_name",setting()->name);
        OpenGraph::addProperty('locale','vi');
        if($post->post_image_max!=NULL){
            if ( file_exists(public_path($post->post_image_max))&&$post->post_image_max!=""){
                $post_image = $post->post_image_max;
            }else{
                $post_image = 'uploads/defaults/_post.jpg';
            }
        }else{
            $post_image = 'uploads/defaults/_post.jpg';
        }
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
        // dd($post->lastItem(),$post->perPage());
        return view("web.pages.news.pages.single.single",['post'=>$post,'viewBlade'=>'single']);
    }
    public function viewCategory($posts,$cate)
    {
        SEOTools::setTitle($cate->cate_name);
        SEOTools::setDescription($cate->cate_des);
        SEOTools::opengraph()->setUrl(\URL::current());
        SEOMeta::addMeta('article:published_time', $cate->created_at, 'property');
        SEOMeta::addMeta('article:section',$cate->cate_name, 'property');
        OpenGraph::addProperty("og:site_name",setting()->name);
        OpenGraph::addProperty('locale','vi');
        $cate->img = "/uploads/defaults/category.png";
        OpenGraph::addProperty('image',asset($cate->img));
        OpenGraph::addProperty('image:secure_url',asset($cate->img));
        OpenGraph::addProperty("twitter:image",asset($cate->img));
        $image = getimagesize(public_path($cate->img));
        OpenGraph::addProperty("image:width",$image[0]);
        OpenGraph::addProperty("image:height",$image[1]);
        OpenGraph::addProperty('url',url()->current());
        OpenGraph::addProperty('article:published_time', $cate->created_at);
        OpenGraph::addProperty('article:modified_time', $cate->updated_at);
        OpenGraph::addProperty("twitter:site", setting()->name);
        OpenGraph::addProperty("twitter:title",$cate->cate_name);
        return view("web.pages.news.pages.category.category",['posts'=>$posts,'cate'=>$cate]);
    }
    public function getPostByCategory($cate)
    {
        $posts = $this->PostsRepository->getPostByCategoryID($cate);
        return $posts;
    }
    public function getPostSingleBySlug($post_slug)
    {
        return  $this->PostsRepository->getPostSingleBySlug($post_slug);
    }
}
