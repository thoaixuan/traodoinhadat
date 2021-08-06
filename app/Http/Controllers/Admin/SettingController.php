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
use App\Http\Requests\Admin\Setting\SettingEditRequest;
use App\Models\Setting;
class SettingController extends Controller
{
    public $SettingsRepository;
    public function __construct(SettingsRepository $SettingsRepository){
        $this->SettingsRepository = $SettingsRepository;
    }
    public function getSetting(Request $request)
    {

        SEOTools::setTitle(setting()->name." - Cài đặt chung ");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view('admin.pages.setting.action');
    }
    public function postEdit(SettingEditRequest $request)
    {
        $route_admin = trim($request->route_admin);
        if($route_admin=='Admin'||$route_admin=='admin'||$route_admin=='Auth'||$route_admin=='Auth'){
            $request['route_admin'] = trim('cpanel');
        }else{
            $request['route_admin'] = $route_admin;
        }
        $route_login = trim($request->route_login);
        if($route_login=='Admin'||$route_login=='admin'){
            $request['route_login'] = $route_login;
        }else{
            $request['route_login'] = $route_login;
        }
        if($request->type=='updateSeting'){
            $result = $this->SettingsRepository->editSetting($request);
            if($result){
                return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Cập nhật thành công ",'url'=>route('web.home.index').'/'.$route_admin.'/'.'setting' ), 200);
            }else{
                return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"Cập nhật thất bại !" ), 200);
            }
        }else{
            $result = $this->SettingsRepository->testMail($request);
            if($result===true){
                return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Gửi thành công " ), 200);
            }else{
                return  response()->json(array('status'=>'error','icon'=>'danger','msg'=>"$result" ), 200);
            }
        }
    }
}
