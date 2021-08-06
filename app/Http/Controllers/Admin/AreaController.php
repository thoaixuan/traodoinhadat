<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Area\ProvinceRepository;
use App\Repositories\Area\DistrictRepository;
use App\Repositories\Area\WardRepository;
use App\Http\Requests\Admin\Area\actionRequest;
use App\Models\Ward;

class AreaController extends Controller
{

   public $ProvinceRepository;
   public $DistrictRepository;
   public $WardRepository;
   public function __construct(
      ProvinceRepository $ProvinceRepository,
      DistrictRepository $DistrictRepository,
      WardRepository $WardRepository
   ){
      $this->ProvinceRepository = $ProvinceRepository;
      $this->DistrictRepository = $DistrictRepository;
      $this->WardRepository = $WardRepository;
   }
   public function getProvinceList(Request $request)
   {
        $request->session()->put('url',null);
       $data = $this->ProvinceRepository->getProvinceList($request);
       return view("admin.pages.area.province",['data'=>$data]);
   }
   public function getDistrictList(Request $request)
   {
        $provinces = $this->ProvinceRepository->getAll();
        $data = $this->DistrictRepository->getDistrictList($request);
        $data = array(
            'provinceID'=>$request->provinceID==null?'':$request->provinceID,
            'search'=>$request->search,
            'provinces'=>$provinces,
            'data'=>$data
        );
        $request->session()->put('url',null);
        return view("admin.pages.area.district", $data);
   }
   public function getWardList(Request $request)
   {

        $provinceID = $request->provinceID==null?'':$request->provinceID;
        $districtID = $request->districtID==null?'':$request->districtID;
        $search =$request->search;
        $provinces = $this->ProvinceRepository->getAll();
        $districts = $this->DistrictRepository->getByProvinceID($provinceID);
        $wards = $this->WardRepository->getWarddistrictID($districtID,$search);
        $request->session()->put('url',null);
        return view("admin.pages.area.ward",[
            'provinces'=>$provinces,
            'provinceID'=>$provinceID,
            'districts'=> $districts,
            'districtID'=> $districtID,
            'wards'=>$wards,
            'search'=>$search,
        ]);
   }
   public function delete(Request $request)
   {
        $result = null;;
        if($request->type=='province'){
            $result = $this->ProvinceRepository->delete(intval($request->id));
        }
        if($request->type=='district'){
            $result = $this->DistrictRepository->delete(intval($request->id));
        }
        if($request->type=='ward'){
            $result = $this->WardRepository->delete(intval($request->id));
        }
        if($result){
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Xóa thành công "), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Xóa thất bại !" ), 200);
        }
    }
    public function add(Request $request)
    {
        $array =array(
            'action'=>'add',
            'type'=>$request->type,
            'name'=>''
        );
        if($request->session()->get('url')==null){
            $request->session()->put('url', url()->previous());
        }
        // dd($request->session()->get('url'));
        if($request->type=='province'){
            $array['action_title']='Thêm mới tỉnh thành';
            $array['type'] = 'province';
        }
        if($request->type=='district'){
            $array['provinces']=$this->ProvinceRepository->getAll();
            $array['action_title']='Thêm mới quận huyện';
            $array['type'] = 'district';
        }
        if($request->type=='ward'){
            $array['provinces']=$this->ProvinceRepository->getAll();
            $array['districts']=array();
            $array['action_title']='Thêm mới phường xã';
            $array['type'] = 'ward';
        }
        return view("admin.pages.area.action.action",$array);
    }
    public function districtAjax(Request $request)
    {
        $districts = $this->DistrictRepository->getByProvinceID($request->provinceID);
        return json_encode($districts);
    }
    public function wardAjax(Request $request)
    {
        $wards = $this->WardRepository->getByDistrictsID($request);
        return json_encode($wards);
    }
    public function edit(Request $request)
    {
        $array =array(
            'action'=>'edit',
            'type'=>$request->type
        );
        if($request->session()->get('url')==null){
            $request->session()->put('url', url()->previous());
            // dd($request->session()->get('url'));
        }
        if($request->type=='province'){
            $data = $this->ProvinceRepository->find(intval($request->id));
            if($data){
                $array['name'] = $data->province_name;
                $array['id'] = $data->id;
                $array['type'] = 'province';
                $array['action_title']='Chỉnh sửa tỉnh thành';
            }else{
                return redirect()->route('admin.province.view');
            }

        }
        if($request->type=='district'){
            $data =  $this->DistrictRepository->find(intval($request->id));
            if($data){
                $array['provinces']=$this->ProvinceRepository->getAll();
                $array['provinceID'] = $data->provinceID;
                $array['name'] = $data->district_name;
                $array['id'] = $data->id;
                $array['type'] = 'district';
                $array['action_title']='Chỉnh sửa quận huyện';
            }else{
                return redirect()->route('admin.ward.view');
            }
        }
        if($request->type=='ward'){
            $data =  $this->WardRepository->find(intval($request->id));
            if($data){
                // provinces
                $array['provinces']=$this->ProvinceRepository->getAll();
                $array['provinceID'] = $data->provinceID;
                $array['districtID'] = $data->districtID;
                $array['name'] = $data->ward_name;
                $array['id'] = $data->id;
                $array['type'] = 'ward';
                $array['action_title']='Chỉnh sửa phường xã';
            }else{
                return redirect()->route('admin.ward.view');
            }

        }
        // dd($array);
        return view("admin.pages.area.action.action",$array);
    }
    public function postAdd(actionRequest $request)
    {
        $result = null;;
        if($request->type=='province'){
            $attr = array(
                "province_name"=>$request->name,
                "province_slug"=>$this->ProvinceRepository->getSlug($request,"update"),
                "created_at"=>date('Y-m-d h:s:i')
            );
            $result = $this->ProvinceRepository->add($attr );
        }
        if($request->type=='district'){
            $result = $this->DistrictRepository->add(array(
                "district_name"=>$request->name,
                "provinceID"=>intval($request->provinceID),
                "district_slug"=>$this->DistrictRepository->getSlug($request,"insert"),
                "created_at"=>date('Y-m-d h:s:i')
            ));
        }
        if($request->type=='ward'){
            $result = $this->WardRepository->add(array(
                "provinceID"=>intval($request->provinceID),
                "districtID"=>intval($request->districtID),
                "ward_name"=>$request->name,
                "ward_slug"=>$this->WardRepository->getSlug($request,"insert"),
                "created_at"=>date('Y-m-d h:s:i')
            ));
        }
        $url = $request->session()->get('url');
        if($result){
            $request->session()->put('url',null);
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Thêm thành công ",'url'=>$url), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Thêm thất bại !",'url'=>$url ), 200);
        }
    }
    public function postEdit(actionRequest $request)
    {
        $result = null;;
        if($request->type=='province'){
            $attr = array();
            $attr["province_name"]=$request->name;
            $attr["province_slug"]= $this->ProvinceRepository->getSlug($request,"update");
            $attr["updated_at"]=date('Y-m-d h:s:i');
            $result = $this->ProvinceRepository->edit(intval($request->id),$attr);
        }
        if($request->type=='district'){
            $result = $this->DistrictRepository->edit(intval($request->id),array(
                "district_name"=>$request->name,
                "provinceID"=>$request->provinceID,
                "district_slug"=>$this->DistrictRepository->getSlug($request,"update"),
                "updated_at"=>date('Y-m-d h:s:i')
            ));
        }
        if($request->type=='ward'){
            $result = $this->WardRepository->edit(intval($request->id),array(
                "ward_name"=>$request->name,
                "provinceID"=>$request->provinceID,
                "districtID"=>$request->districtID,
                "ward_slug"=>$this->WardRepository->getSlug($request,"update"),
                "updated_at"=>date('Y-m-d h:s:i')
            ));
        }
        $url = $request->session()->get('url');
        if($result){
            $request->session()->put('url',null);
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cật nhật thành công ",'url'=>$url), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cật nhật thất bại !" ,'url'=>$url), 200);
        }
    }

}
