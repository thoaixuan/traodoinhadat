<?php

namespace App\Http\Controllers\Web;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Realestate;
use App\Views\RealestateView;
use App\Repositories\Realestate\RealestateRepository;
use App\Repositories\Categorys\CategorysRepository;
use App\Http\Requests\Web\Realestate\RealestateRequest;
use Auth;
class RealestateController extends Controller
{
    public $CategorysRepository;
    public $RealestateRepository;
    public function __construct(CategorysRepository $CategorysRepository,RealestateRepository $RealestateRepository){
        $this->CategorysRepository = $CategorysRepository;
        $this->RealestateRepository = $RealestateRepository;
    }
    public function getRealestateSend(Request $request)
    {
        SEOTools::setTitle("Gửi bất động sản");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("web.pages.realestate.send",['realestate'=>new Realestate(),'type'=>'insert']);
    }
    /* trao do nha dat*/
    public function getTrans(Request $request)
    {
        SEOTools::setTitle("Trao đổi nhà đất");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("web.pages.realestate.trans");
    }
    /* */
    public function postRealestateAjaxSend(RealestateRequest $request)
    {
        /*if(checkAntispam($request)){
            return checkAntispam($request);
        }*/
        $result = $this->RealestateRepository->saveSendData($request);
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Gửi thành công"), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Gửi không thành công"), 200);
        }
    }
    public function Delete(Request $request)
    {
        $result = $this->RealestateRepository->delete(intval($request->id));
        if($result){
            $FOLDER  = "/uploads/realestate/realestateID{$request->id}";
            \File::deleteDirectory(public_path($FOLDER));
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Xóa thành công"), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Xóa không thành công !"), 200);
        }
    }
    public function getData(Request $request)
    {
        $breadcrumbs = breadcrumbs();
        $data = array();
        $data['breadcrumbs']=$breadcrumbs;
        foreach(array_reverse($breadcrumbs) as $item){
            if($item->key=='realestate'){
                $data['data'] =  $this->getChiTiet($request,$item);
                return $this->viewChiTiet($data);
            }else if($item->key=='ward'){
                $data['data'] =  $this->getDanhSach($request,$item);
                return $this->viewDanhSach($data);
            }else if($item->key=='district'){
                $data['data'] =  $this->getDanhSach($request,$item);
                return $this->viewDanhSach($data);
            }else if($item->key=='province'){
                $data['data'] =  $this->getDanhSach($request,$item);
                return $this->viewDanhSach($data);
            }else if($item->key=='category'){
                $data['data'] =  $this->getDanhSach($request,$item);
                return $this->viewDanhSach($data);
            }else{
                $data['data'] =  $this->getDanhSach($request,$item);
                return $this->viewDanhSach($data);
            }
        }
    }
    public function viewDanhSach($data)
    {
        $info = $data['data']->info;
        SEOTools::setTitle($info->name.' - '.setting()->title);
        SEOTools::setDescription(setting()->des);
        SEOTools::opengraph()->setUrl(\URL::current());
        OpenGraph::addProperty("og:site_name",setting()->name);
        OpenGraph::addProperty('locale','vi');
        OpenGraph::addProperty('url',url()->current());
        OpenGraph::addProperty("twitter:site", setting()->name);
        return view('web.pages.realestate.show.danh-sach',$data);
    }
    public function viewChiTiet($data)
    {
        SEOTools::setTitle($data['data']->result->realestate_title.' - '.setting()->title);
        SEOTools::opengraph()->setUrl(\URL::current());
        OpenGraph::addProperty("og:site_name",setting()->name);
        OpenGraph::addProperty('locale','vi');
        OpenGraph::addProperty('url',url()->current());
        OpenGraph::addProperty("twitter:site", setting()->name);
        return view('web.pages.realestate.show.chi-tiet',$data);
    }
    public function getChiTiet($request,$data)
    {
        $std = new \stdClass;
        $std->result = RealestateView::where('realestate_slug','=',$data->slug)->first();
        $std->images = array();
        if($std->result){
            $std->images = $this->RealestateRepository->getImage($std->result->id);
        }
        return $std;
    }
    public function getDanhSach($request,$data)
    {

        $std = new \stdClass;
        $std->result = array();
        $std->count = 0;
        $std->info = $data;
        $where =$data->where;
        $sort = 'id';
        $direction = 'desc';
        if($request->sort||$request->direction){
            $sort = $request->sort;
            $direction = $request->direction;
        }
        if($request->min&&$request->max){
            $where[]=['realestate_dat_dientich', '>=',intval($request->min)];
            $where[]=['realestate_dat_dientich', '<=',intval($request->max)];
        }
        if($request->hem){
            $where[]=['realestate_nha_hem', '=',$request->hem];
        }
        if($request->huong){
            $where[]=['realestate_nha_huong', '=',$request->huong];
        }
        if($request->tan){
            $where[]=['realestate_nha_tan', '=',$request->tan];
        }
        if($request->phongngu){
            $where[]=['realestate_nha_phongngu', '=',$request->phongngu];
        }
        if($request->phongtam){
            $where[]=['realestate_nha_phongtam', '=',$request->phongtam];
        }
        if($request->dacbiet){
            $where[]=['realestate_hot', '=','on'];
        }
        if($request->dathamdinh){
            $where[]=['realestate_expertise', '=','on'];
        }
        if($request->daban){
            $where[]=['realestate_sold', '=','on'];
        }


            if($request->q==""||$request->q==null){
                $std->result = RealestateView::where($where)->orderBy($sort,$direction)->sortable()->paginate(9);
                $std->count = RealestateView::where($where)->count();
            }else{

                $search = $request->q;

                $std->result = RealestateView::where($where)
                ->where(function($query)use($search){
                    $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('realestate_title', 'LIKE',"%{$search}%")
                    ->orWhere('full_name', 'LIKE',"%{$search}%")
                    ->orWhere('province_name', 'LIKE',"%{$search}%")
                    ->orWhere('district_name', 'LIKE',"%{$search}%")
                    ->orWhere('ward_name', 'LIKE',"%{$search}%")
                    ->orWhere('cate_name', 'LIKE',"%{$search}%");
                })->orderBy($sort,$direction)->sortable()->paginate(9);

                $std->count = count($std->result);
            }

        return $std;
    }
    public function postRealestateAjaxSave(Request $request)
    {
        $result = $this->RealestateRepository->saveRealestate($request);
        if($result){
            if($request->status=='add'){
                return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Lưu thành công "),200);
            }else{
                return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Bỏ lưu thành công "),200);
            }
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Lưu thành công"), 200);
        }
    }
}
