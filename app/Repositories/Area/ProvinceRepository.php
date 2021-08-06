<?php
namespace App\Repositories\Area;

use App\Repositories\EloquentRepository;
use App\Models\Province;
use Cviebrock\EloquentSluggable\Services\SlugService;
class ProvinceRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Province::class;
    }
    public function getProvinceList($request)
    {
        $where = array(
            ['id','!=',null]
        );
        if(!empty($request->q)){
            $search = $request->q;
            $result =  Province::where($where)
            ->Where(function($query)use($search){
                $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('province_name', 'LIKE',"%{$search}%");
            })
            ->sortable()
             ->orderBy('id','desc')
            ->paginate(20);
            return $result;
        }else{
            $result =  Province::where($where)
            ->sortable()
             ->orderBy('id','desc')
            ->paginate(20);
            return $result;
        }
    }

    public function delete($id){
        return Province::where('id','=',$id)->delete();
    }
    public function getByID($id)
    {
        return Province::where('id','=',$id)->first();
    }
    public function getSlug($request,$type)
    {
        if($type=='update'){
            $count = Province::where('province_slug','=',to_slug($request->name))->where('id','!=',$request->id)->count();
            if($count>0) return SlugService::createSlug(Province::class, 'province_slug', $request->name,['unique' => true]);
            return false;
        }else{
            return SlugService::createSlug(Province::class, 'province_slug', $request->name,['unique' => true]);
        }
    }
}
