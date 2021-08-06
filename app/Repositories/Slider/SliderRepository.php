<?php
namespace App\Repositories\Slider;

use App\Repositories\EloquentRepository;
use App\Models\Slider;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Image;
class SliderRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Slider::class;
    }
    public function getSliderList($request)
    {
        $where = array(
            ['status','!=',null]
        );
        if(isset($request->type)&&!empty($request->type)){
            $where[] = ['type','=',$request->type];
        }
        if(!empty($request->q)){
                $search = $request->q;
                $result =  Slider::where($where)
                ->Where(function($query)use($search){
                    $query->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('image', 'LIKE',"%{$search}%")
                    ->orWhere('link', 'LIKE',"%{$search}%")
                    ->orWhere('name', 'LIKE',"%{$search}%")
                    ->orWhere('created_at', 'LIKE',"%{$search}%");
                })
                ->sortable()
                ->orderBy('id','desc')
                ->paginate(10);
                return $result;
        }else{
                $result =  Slider::where($where)
                ->sortable()
                ->orderBy('id','desc')
                ->paginate(10);
                return $result;
        }
    }
    public function editSlider($request)
    {
        $rs = Slider::find($request->id);
        $rs->type = $request->type;
        $rs->status = $request->status;
        $rs->name = $request->name;
        $image =$this->uploadImage($request,'update');
        if($image){
            $rs->image =$image;
        }
        $rs->link = $request->link;
        $result = $rs->save();
        if($result){
            return true;
        }else{
            return false;
       }
    }
    public function addSlider($request)
    {
        $rs = new Slider();
        $rs->type = $request->type;
        $rs->status = $request->status;
        $rs->name = $request->name;
        $image =$this->uploadImage($request,'insert');
        if($image){
                $rs->image =$image;
        }
        $rs->link = $request->link;
        $result = $rs->save();
        if($result){
                return true;
        }else{
            return false;
        }
    }
    public function uploadImage($request,$type)
    {
        $path  = "/uploads/sliders";
        $file      = $request->file('file_slider_image');
        if($type=='insert'){
            if ($file) {
                $extension = $file->getClientOriginalExtension();
                $picture   = time().uniqid().'.'.$extension;
                $Image = Image::make($file);
                $Image->save(public_path("{$path}/{$picture}"));
                return  "{$path}/{$picture}";
            }
            return false;
        }else{
            $result =  Slider::find($request->id);
            if ($file) {
                if (file_exists(public_path($result->image))) {
                    \File::delete(public_path($result->image));
                }
                $extension = $file->getClientOriginalExtension();
                $picture   =  time().uniqid().'.'.$extension;
                $max = Image::make($file);
                $max->save(public_path("{$path}/{$picture}"));
                return "{$path}/{$picture}";
            }
            return false;
        }
        return false;
    }
    public function deleteSlider($request)
    {
        $Slider = Slider::find($request->id);
        if (file_exists(public_path($Slider->image))) {
            \File::delete(public_path($Slider->image));
        }
        if($Slider->delete()){
            return true;
        }return false;
    }
    public function statusSlider($request)
    {
        $result =  Slider::find($request->id);
        if($result){
            $result->status = 'on';
            if($result->save())return true;
            return false;
        }return false;
    }

}
