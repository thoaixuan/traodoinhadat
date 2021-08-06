<?php
namespace App\Repositories\Area;

use App\Repositories\EloquentRepository;
use App\Models\District;
use Cviebrock\EloquentSluggable\Services\SlugService;
class DistrictRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return District::class;
    }
    public function getDistrictList($request)
    {

        $where = array(
            ['provinceID','=',$request->provinceID]
        );
        if(!empty($request->q)){
            $search = $request->q;
            $result =  District::where($where)
            ->Where(function($query)use($search){
                $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('district_name', 'LIKE',"%{$search}%");
            })
            ->sortable()
             ->orderBy('id','desc')
            ->paginate(20);
            return $result;
        }else{
            $result =  District::where($where)
            ->sortable()
             ->orderBy('id','desc')
            ->paginate(20);
            return $result;
        }
    }
    public function getByProvinceID($provinceID)
    {
        return District::where('provinceID','=',$provinceID)->get();
    }
    public function getSlug($request,$type)
    {
        if($type=='update'){
            $count = District::where('district_slug','=',to_slug($request->name))->where('id','!=',$request->id)->count();
            if($count>0) return SlugService::createSlug(District::class, 'district_slug', $request->name,['unique' => true]);
            return false;
        }else{
            return SlugService::createSlug(District::class, 'district_slug', $request->name,['unique' => true]);
        }
    }
}
