<?php

namespace App\Http\Controllers\Admin;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Settings\SettingsRepository;
use App\Http\Requests\Admin\Role\RoleAddRequest;
use App\Http\Requests\Admin\Role\RoleEditRequest;
use App\Models\Roles;
use App\Models\Posts;
use App\Models\Categorys;
use App\Views\PostsView;
use App\Views\RealestateView;
use Carbon\Carbon;
class SitemapController extends Controller
{

    public $SettingsRepository;
    public function __construct(SettingsRepository $SettingsRepository){
        $this->SettingsRepository = $SettingsRepository;
    }

    public function getIndex(Request $request)
    {
        SEOTools::setTitle(setting()->name." - Công cụ seo ");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view('admin.pages.sitemap.index');
    }
    public function postUpdate(Request $request)
    {
        $result = $this->SettingsRepository->updateSeo($request);
        if($result){
            $this->cronjobUpdate($request);
            return json_encode (array('status'=>'success','msg'=>'Cập nhật sitemap thành công'));
        }else{
            return json_encode (array('status'=>'success','msg'=>'Cập nhật sitemap thất bại !'));
        }
    }
    public function showSitemap(Request $request)
    {
        $sitemap = app()->make('sitemap');
        $sitemap->setCache(setting()->name, 60);
        if (!$sitemap->isCached()) {
            $sitemap = $this->bds($sitemap);
            $sitemap = $this->category($sitemap);
            $sitemap = $this->post($sitemap);
        }
        $this->cronjobUpdate($request);
        return $sitemap->render('xml');
    }
    public function cronjobUpdate(Request $request)
    {
        \Config::set("sitemap.use_styles",false);
        $sitemap = \App::make('sitemap');
        $sitemap->add(url('/'), Carbon::now(), 1, setting()->sitemap_frequency);
        $sitemap = $this->bds($sitemap);
        $sitemap = $this->category($sitemap);
        $sitemap = $this->post($sitemap);
        $sitemap->store('xml', 'sitemap');
        if($request->ajax()){
            return json_encode (array('status'=>'success','msg'=>'Cập nhật sitemap thành công ^^'));
        }
        return "CẬP NHẬT THÀNH CÔNG";
    }
    public function getDowload(Request $request)
    {
        $file= public_path(). "/sitemap.xml";
        return \Response::download($file, 'sitemap.xml');
    }
    //SET sitemap
    public  function home($sitemap)
    {
        $sitemap->add(route('web.home.index'),date('Y-m-d h:s:i'), 1, setting()->sitemap_frequency);
        return  $sitemap;
    }

    public function category($sitemap)
    {
        $posts =Categorys::limit(100)->where('cate_type','=','cate_news')->orderBy('id','desc')->get();
        foreach ($posts as $value) {
            if($value->cate_slug!=null&&$value->cate_slug_parent!=null){
                $sitemap->add(route('web.news.news',[$value->cate_slug_parent,$value->cate_slug]), $value->updated_at, 2, setting()->sitemap_frequency);
            }else{
                $sitemap->add(route('web.news.news',$value->cate_slug), $value->updated_at, 2, setting()->sitemap_frequency);
            }

        }
        return  $sitemap;
    }
    public function post($sitemap)
    {
        $posts =PostsView::limit(100)->orderBy('id','desc')->get();
        foreach ($posts as $value) {
            if($value->cate_slug!=null&&$value->cate_slug_parent!=null){
                $sitemap->add(route('web.news.news',[$value->cate_slug_parent,$value->cate_slug,$value->post_slug]), $value->updated_at, 1, setting()->sitemap_frequency);
            }else{
                $sitemap->add(route('web.news.news',[$value->cate_slug,$value->post_slug]), $value->updated_at, 1, setting()->sitemap_frequency);
            }

        }
        return  $sitemap;
    }
    public function bds($sitemap)
    {
        $posts =RealestateView::limit(100)->orderBy('id','desc')->get();
        foreach ($posts as $value) {
            $sitemap->add(getRealestateUrl($value), $value->updated_at, 1, setting()->sitemap_frequency);
        }
        return  $sitemap;
    }

}

