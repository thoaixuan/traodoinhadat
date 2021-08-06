<?php
namespace App\Repositories\Area;

use App\Repositories\EloquentRepository;
use App\Models\Ward;
use Cviebrock\EloquentSluggable\Services\SlugService;
class WardRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Ward::class;
    }
    public function getByDistrictsID($request)
    {
        return Ward::where('districtID','=',$request->districtID)->get();
    }
    public function getWarddistrictID($districtID,$search)
    {
        $where = array(
            ['districtID','=',$districtID]
        );
        if(!empty($search)){
            $search = $search;
            $result =  Ward::where($where)
            ->Where(function($query)use($search){
                $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('ward_name', 'LIKE',"%{$search}%");
            })
            ->orderBy('id','desc')
            ->sortable()
            ->paginate(20);
            return $result;
        }else{
            $result =  Ward::where($where)
            ->sortable()
            ->orderBy('id','desc')
            ->paginate(20);
            return $result;
        }
    }
    public function getSlug($request,$type)
    {
        if($type=='update'){
            $count = Ward::where('ward_slug','=',to_slug($request->name))->where('id','!=',$request->id)->count();
            if($count>0) return SlugService::createSlug(Ward::class, 'ward_slug', $request->name,['unique' => true]);
            return false;
        }else{
            return SlugService::createSlug(Ward::class, 'ward_slug', $request->name,['unique' => true]);
        }
    }

}
