<?php

namespace App\Http\Controllers\Admin;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Auth\AuthRepositories;
use Auth;
use App\Models\Users;
use Illuminate\Contracts\Session\Session;
use App\Http\Requests\Web\Profile\TokenchangpassRequest;
class LoginController extends Controller
{
    public $AuthRepositories;
    public function __construct(
        AuthRepositories $AuthRepositories
    ){
        $this->AuthRepositories = $AuthRepositories;

    }
    public function getLogin(Request $request)
    {
        SEOTools::setTitle("Đăng nhập");
        SEOTools::opengraph()->setUrl(\URL::current());
        if(Auth::check()){
            return redirect()->route('admin.dashboard.view');
        }
        return view('admin.pages.auth.login');
    }
    public function ajaxLogin(Request $request)
    {
        $url = route('admin.dashboard.view');
        $_checkLogin = $this->AuthRepositories->_checkLogin($request->phone,$request->password);
        if($_checkLogin){
            $request->session()->forget('url');
            return  response()->json(array('status'=>'success','icon'=>'success','msg'=>"Đăng nhập thành công ",'url'=>$url), 200);
        }else{
            return  response()->json(array('status'=>'error','icon'=>'error','msg'=>"Thông tin đăng nhập không hợp lệ ! "), 200);
        }
    }
    public function getLogout(Request $request)
    {
        if(Auth::logout()){
            return redirect()->route('admin.auth.login')->with('status_forgot_success',"Đăng xuất thành công ");
        }
        return redirect()->route('admin.auth.login')->with('status_forgot_success',"Đăng xuất thành công ");
    }
    public function forgot(Request $request)
    {
        SEOTools::setTitle("Tìm email");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view('admin.pages.auth.forgot');
    }
    public function postForgot(Request $request)
    {
        $user = Users::where('email','=',$request->email)->first();
        if($user){
            $user->pass_verified_token = uniqid().csrf_token().uniqid().$user->id;
            configMail();
            $rs =  _sendMail([
                "template"=>"admin.pages.auth.template-mail.forgot",
                "data"=>['pass_verified_token'=>$user->pass_verified_token],
                "mailSend"=>[$user->email],
                "subject"=>"Lây lại mật khẩu"
            ]);
            if($rs==true){
                $user->save();
                return redirect()->route('admin.auth.login')->with('status_forgot_success',"Vui lòng kiểm tra Email {$user->email} để lấy lại mật khẩu ");
            }else{
                return redirect()->route('admin.auth.login')->with('status_forgot_error','Hiện tại máy chủ không thể thực hiện được !');
            }
        }else{
            return redirect()->route('admin.auth.login')->with('status_forgot_error','Email của bạn không tồn tại trong hệ thống !');
        }
    }
    public function getChangePassWord (Request $request)
    {
        SEOTools::setTitle("Cập nhật mật khẩu");
        SEOTools::opengraph()->setUrl(\URL::current());
        $user = Users::where('pass_verified_token','=',$request->token)->first();
        if($user){
            return view('admin.auth.change-pass',['token'=>$request->token]);
        }else{

        }
    }
    public function postChangePassWord (TokenchangpassRequest $request)
    {
        $user = Users::where('pass_verified_token','=',$request->token)->first();
        if($user){
                $user->password = \Hash::make($request->new_password);
                $user->pass_verified_token =NULL;
                if($user->save()){
                    return response()->json(array(
                        "status"=>'success',
                        "msg"=>"Cập nhật mật khẩu thành công"
                    ), 200);
                }else{
                    return response()->json(array(
                        "status"=>'error',
                        "msg"=>"Cập nhật mật khẩu thất bại"
                    ), 200);
                }

        }else{
            return response()->json(array(
                "status"=>'error',
                "msg"=>"Token không hợp lệ !"
            ), 200);
        }

    }

}
