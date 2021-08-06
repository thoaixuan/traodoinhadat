<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Config;
use Auth;
class SocialController extends Controller
{
    public function __construct(){
        Config::set("services.facebook.client_id",setting()->facebook_client_id);
        Config::set("services.facebook.client_secret",setting()->facebook_client_secret);
        Config::set("services.facebook.redirect",route('web.social.callback','facebook'));
        Config::set("services.google.client_id",setting()->google_client_id);
        Config::set("services.google.client_secret",setting()->google_client_secret);
        Config::set("services.google.redirect",route('web.social.callback','google'));
    }
    protected $providers = [
        'facebook','google'
    ];
    public function redirectToProvider($driver)
    {
        if(!$this->isProviderAllowed($driver)) {
            return $this->sendFailedResponse("{$driver} is not currently supported");
        }
        try {
            return Socialite::driver($driver)->redirect();
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }
    }
    public function handleProviderCallback($driver)
    {
        try {
            $user = Socialite::driver($driver)->user();
            return empty($user->email) ? $this->sendFailedResponse("No email id returned from {$driver} provider.") : $this->loginOrCreateAccount($user, $driver);
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }
    }
    protected function sendSuccessResponse()
    {
        return redirect()->route('web.home.index');
    }
    protected function sendUpdatePhoneNumber()
    {
        return redirect()->route('web.account.hoso');
    }
    protected function sendFailedResponse($msg = null)
    {
        return redirect()->back()->with('status_login', $msg ?: 'Unable to login, try with another provider to login.');
    }
    protected function loginOrCreateAccount($providerUser, $driver)
    {
        $isNew = false;
        $user = User::where('email', $providerUser->getEmail())->first();
        if( $user ) {
            $user->update([
                'full_name' => $providerUser->getName(),
                'avatar' => $providerUser->avatar,
                'provider' => $driver,
                'provider_id' => $providerUser->id,
                'access_token' => $providerUser->token
            ]);
        } else {
            if($providerUser->getEmail()){
                $user = User::create([
                    'type' => "userCreate",
                    'full_name' => $providerUser->getName(),
                    'email' => $providerUser->getEmail(),
                    'avatar' => $providerUser->getAvatar(),
                    'provider' => $driver,
                    'provider_id' => $providerUser->getId(),
                    'access_token' => $providerUser->token,
                    'password' => ''
                ]);
            }else{
                $this->sendFailedResponse("No email id returned from {$driver} provider.");
            }
            $isNew = true;
        }
        Auth::login($user, true);
        if ($isNew) {
            return $this->sendUpdatePhoneNumber();
        }
        return $this->sendSuccessResponse();
    }
    private function isProviderAllowed($driver)
    {

        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }
}
