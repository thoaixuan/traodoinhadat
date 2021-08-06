<?php
namespace App\Repositories\Categorys;

use App\Repositories\EloquentRepository;
use App\Models\Categorys;
use Cviebrock\EloquentSluggable\Services\SlugService;
class CategorysRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Categorys::class;
    }
    public function getCategoryPost()
    {
        $data = array();
        $parents =  Categorys::where('cate_status','=',0)->where('cate_type','=','cate_news')->where('cate_parentID','=',null)->get();
        $childs =  Categorys::where('cate_status','=',0)->where('cate_type','=','cate_news')->where('cate_parentID','!=',null)->get();
        foreach($parents as $parent){
            $row = new \stdClass;
            $row->id = $parent->id;
            $row->cate_name = $parent->cate_name;
            $row->url = route('web.news.news',$parent->cate_slug);
            $row->created_at = $parent->created_at;
            $row->sub_menu = [];
            foreach($childs as $child){
                if($parent->id==$child->cate_parentID){
                    $_row = new \stdClass;
                    $_row->id = $child->id;
                    $_row->cate_name = $child->cate_name;
                    $_row->url = route('web.news.news',[$parent->cate_slug,$child->cate_slug]);
                    $_row->created_at = $child->created_at;
                    $row->sub_menu[]=$_row;
                }
            }
            $data[]=$row;
        }
        return $data;
    }
    public function getListParent()
    {

        $data = Categorys::where('cate_parentID','=',NULL)->where('cate_type','=','cate_news')->get();
        return $data;
    }
    public function getInfoCatgoryBySlug($parent=null,$child=null)
    {
        if($parent!=null&&$child!=null){
            return   Categorys::where('cate_slug_parent','=',$parent)->where('cate_slug','=',$child)->first();
        }else{
            return Categorys::where('cate_slug','=',$parent)->first();
        }

    }
    public function getParentDatatable($request)
    {
        $columns[]="id";
        $columns[]="cate_icon";
        $columns[]="cate_name";
        $columns[]="cate_order";
        $columns[]="created_at";
        $columns[]="id";
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('inputSearch');
        $totalData =  Categorys::where('cate_parentID','=',NULL)->where('cate_type','=','cate_news')->count();
        $totalFiltered =$totalData;
        if(empty($search)){
            $Postcategory =Categorys::where('cate_parentID','=',NULL)->where('cate_type','=','cate_news')->offset($start)
            ->limit($limit)
            ->orderBy($order,$dir)
            ->get();
        }else{
            $Postcategory =Categorys::where('cate_type','=','cate_news')->Where(function($query)use($search){
                $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('cate_name', 'LIKE',"%{$search}%")
                ->orWhere('cate_des', 'LIKE',"%{$search}%")
                ->orWhere('cate_order', 'LIKE',"%{$search}%")
                ->orWhere('created_at', 'LIKE',"%{$search}%");
            })
            ->offset($start)
            ->limit($limit)
            ->orderBy($order,$dir)
            ->get();
            $totalFiltered =count($Postcategory);
        }
        $data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $Postcategory
        );

        return $data;
    }
    public function getSubDatatable($request)
    {
        $columns[]="id";
        $columns[]="cate_icon";
        $columns[]="cate_name";
        $columns[]="cate_order";
        $columns[]="created_at";
        $columns[]="id";
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('inputSearch');
        $cate_parentID = $request->input('selectCategoryID');

        $where =  array(
            ['cate_parentID','!=',NULL],
            ['cate_type','=','cate_news']
        );
        if(!empty($cate_parentID)){
            unset($where[0]);
            $where[]=['cate_parentID','=',$cate_parentID];
        }
        $totalData =  Categorys::where($where )->count();
        $totalFiltered =$totalData;
        if(empty($search)){
            $Postcategory =Categorys::where($where )->offset($start)
            ->limit($limit)
            ->orderBy($order,$dir)
            ->get();
        }else{
            $Postcategory =Categorys::where($where)->Where(function($query)use($search){
                $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('cate_name', 'LIKE',"%{$search}%")
                ->orWhere('cate_des', 'LIKE',"%{$search}%")
                ->orWhere('cate_order', 'LIKE',"%{$search}%")
                ->orWhere('created_at', 'LIKE',"%{$search}%");
            })
            ->offset($start)
            ->limit($limit)
            ->orderBy($order,$dir)
            ->get();
            $totalFiltered =count($Postcategory);
        }
        $data = array();
        foreach ($Postcategory as $value) {
            if (!file_exists(public_path($value->cate_icon))) {
                $value->cate_icon ='/uploads/defaults/default.png';
            }
            if($value->cate_icon==null){
                $value->cate_icon ='/uploads/defaults/default.png';
            }
            $data[]=$value;
        }
        $data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $Postcategory
        );

        return $data;
    }
    public function getCategoryByID($request)
    {
        return Categorys::where('id','=',$request->id)->first();
    }
    public function getSlug($request,$type)
    {
        if($type=='edit'){
            $count = Categorys::where('cate_slug','=',to_slug($request->cate_name))->where('id','!=',$request->id)->count();
            if($count>0) return SlugService::createSlug(Categorys::class, 'cate_slug', $request->cate_name,['unique' => true]);
            return false;
        }else{
            return SlugService::createSlug(Categorys::class, 'cate_slug', $request->cate_name,['unique' => true]);
        }
    }
    public function editParentCategory($request)
    {
        $data = Categorys::find($request->id);
        $data->cate_name = $request->cate_name;
        $data->cate_slug =$this->getSlug($request,'edit');
        $data->cate_des = $request->cate_des;
        $data->cate_order = $request->cate_order;
        $cate_icon = $this->uploadIcon($request,'edit');
        $data->cate_type = 'cate_news';
        if($cate_icon){
            $data->cate_icon = $cate_icon;
        }
        if($data->save()){
            return true;
        }
        return false;
    }
    public function editSubCategory($request)
    {
        $parentCategory = Categorys::find($request->cate_parentID);
        $data = Categorys::find($request->id);
        $data->cate_parentID = $parentCategory->id;
        $data->cate_name = $request->cate_name;
        $data->cate_slug_parent = $parentCategory->cate_slug;
        $data->cate_slug =$this->getSlug($request,'edit');
        $data->cate_des = $request->cate_des;
        $data->cate_order = $request->cate_order;
        $cate_icon = $this->uploadIcon($request,'edit');
        $data->cate_type = 'cate_news';
        if($cate_icon){
            $data->cate_icon = $cate_icon;
        }
        if($data->save()){
            return true;
        }
        return false;
    }
    public function addParentCategory($request)
    {
        $data = new Categorys();
        $data->cate_name = $request->cate_name;
        $data->cate_slug =$this->getSlug($request,'add');
        $data->cate_des = $request->cate_des;
        $data->cate_order = $request->cate_order;
        $cate_icon = $this->uploadIcon($request,'add');
        $data->cate_type = 'cate_news';
        if($cate_icon){
            $data->cate_icon = $cate_icon;
        }
        if($data->save()){
            return true;
        }
        return false;
    }
    public function addSubCategory($request)
    {
        $parentCategory = Categorys::find($request->cate_parentID);
        $data = new Categorys();
        $data->cate_parentID = $parentCategory->id;
        $data->cate_name = $request->cate_name;
        $data->cate_slug_parent = $parentCategory->cate_slug;
        $data->cate_slug =$this->getSlug($request,'add');
        $data->cate_des = $request->cate_des;
        $data->cate_order = $request->cate_order;
        $data->cate_type = 'cate_news';
        $cate_icon = $this->uploadIcon($request,'add');
        if($cate_icon){
            $data->cate_icon = $cate_icon;
        }
        if($data->save()){
            return true;
        }
        return false;
    }
    public function deleteCategory($request = null)
    {
        $result =  Categorys::find($request->id);
        if (file_exists(public_path($result->cate_icon))) {
            \File::delete(public_path($result->cate_icon));
        }
        if($result->delete()){
            return true;
        }return false;
    }
    public function uploadIcon($request,$action)
    {
        $file      = $request->file('file_cate_icon');
        if ($action == 'add') {
            if ($file) {
                $extension = $file->getClientOriginalExtension();
                $picture   = date('Y-m-d-His').'.'.$extension;
                $file->move(public_path("uploads/categorys/"), $picture);
                return  "/uploads/categorys/{$picture}";
            }
            return false;
        }else{
            $result =  Categorys::find($request->id);
            if ($file) {
               if (file_exists(public_path($result->cate_icon))) {
                  \File::delete(public_path($result->cate_icon));
               }
               $extension = $file->getClientOriginalExtension();
               $picture   = date('Y-m-d-His').'.'.$extension;
               $file->move(public_path("uploads/categorys/"), $picture);
               return  "/uploads/categorys/{$picture}";
            }
            return false;
        }
    }

}
