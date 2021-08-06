<?php
namespace App\Repositories\Ad;

use App\Repositories\EloquentRepository;
use App\Models\Ad;
use Cviebrock\EloquentSluggable\Services\SlugService;
class AdRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Ad::class;
    }
    public function getAdList($request)
    {
        if(!empty($request->q)){
            $search = $request->q;
            $result =  Ad::Where(function($query)use($search){
                $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('type', 'LIKE',"%{$search}%")
                ->orWhere('name', 'LIKE',"%{$search}%")
                ->orWhere('image', 'LIKE',"%{$search}%");
            })
            ->sortable()
            ->paginate(10);
            return $result;
        }else{
            $result =  Ad::sortable()
            ->paginate(10);
            return $result;
        }
    }
    public function getAdByID($request)
    {
        $result = Ad::where('id','=',$request->id)->first();
        if($result ) return  $result;
        return false;
    }
    public function updateAd($request)
    {
        $setting = Ad::find($request->id);
        $image = $this->uploadImage($request);
        if($image){
            $setting->image = $image;
        }
        $setting->status = $request->status;
        $setting->code = $request->code;
        $setting->url = $request->url;
        $setting->file_image_name = $request->file_image_name;
        if($setting->save()){
            return true;
        }else{
            return false;
        }
    }
    public function uploadImage($request)
    {
        $file      = $request->file("file_ad");
        $result =  Ad::find($request->id);
        if ($file) {
            if (file_exists(public_path($result->image))) {
                \File::delete(public_path($result->image));
                $result->image = NULL;
            }
            $picture = $request ->file_image_name;
            $file->move(public_path("uploads/block/"), $picture);
            return  "/uploads/block/{$picture}";
        }
        return false;
    }
    public function statusAd($request)
    {
        $result =  Ad::find($request->id);
        if($result){
            if($result->status=='on'){
                $result->status = 'off';
            }else{
                $result->status = 'on';
            }
            if($result->save())return true;
            return false;
        }return false;
    }
}
