<?php
namespace App\Repositories\Subscribe;

use App\Repositories\EloquentRepository;
use App\Models\Subscribe;
use Cviebrock\EloquentSluggable\Services\SlugService;
class SubscribeRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Subscribe::class;
    }
    public function getSubscribeList($request)
    {
        if(!empty($request->q)){
            $search = $request->q;
            $result =  Subscribe::Where(function($query)use($search){
                $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE',"%{$search}%")
                ->orWhere('subscribe.created_at', 'LIKE',"%{$search}%");
            })
            ->sortable()
            ->paginate(10);
            return $result;
        }else{
            $result =  Subscribe::sortable()
            ->paginate(10);
            return $result;
        }
    }
    public function deleteSubscribe($request)
    {
        $Subscribe = Subscribe::find($request->id);
        if($Subscribe->delete()){
            return true;
        }return false;
    }

}
