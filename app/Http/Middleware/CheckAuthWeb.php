<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class CheckAuthWeb
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $Request ,Closure $next)
    {

            if (Auth::check()) {
                if(\Route::currentRouteName()=='web.account.lienhe'){
                    return $next($Request);
                }else{
                    if(Auth::user()->status==0){
                        return $next($Request);
                    }else{
                        return redirect()->route('web.account.lienhe')->with('status_login_lock','Tài khoản của bạn đã bị khóa vui lòng liên hệ Admin !');
                    }
                }


            }else {
                return redirect()->route('web.home.index')->with('status_login','Vui lòng đăng nhập để tiếp tục !');
            }

    }
}
