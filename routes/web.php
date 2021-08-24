<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => '/db'], function () {
    Route::get('/new', function () {
        \Artisan::call('migrate:fresh --seed');
        return redirect()->route('web.home.index');
    });
    Route::get('/install', function () {
        \Artisan::call('migrate');
        \Artisan::call('migrate:fresh --seed');
        return redirect()->route('web.home.index');
    });
});
Route::get("forgot","LoginController@forgot")->name('web.forgot.index');
Route::post("forgot","LoginController@postForgot")->name('web.forgot.index');
Route::get("change-password","LoginController@getChangePassWord")->name('web.forgot.changePassWord');
Route::post("change-password","LoginController@postChangePassWord")->name('web.forgot.changePassWord');

Route::group(['prefix' => '/'], function () {
    Route::get("/","HomeController@index")->name('web.home.index');
    Route::post("subscribe","HomeController@subscribe")->name('web.subscribe.add');
});
Route::group(['prefix' => 'lien-he'], function () {
    Route::get("/","ContactController@getContactIndex")->name('web.contact.index');
    Route::post("sendContact","ContactController@sendContact")->name('web.contact.sendContact');
    Route::post("datLichTuVan","ContactController@datLichTuVan")->name('web.contact.datLichTuVan');
});
Route::group(['prefix' => 'page'], function () {
    Route::get("ve-chung-toi","PageController@getAboutIndex")->name('web.page.about');
});
Route::group(['prefix' => 'page'], function () {
    Route::get("chinh-sach-bao-mat","PageController@getPrivacyPolicy")->name('web.page.privacy.policy');
});
Route::group(['prefix' => 'page'], function () {
    Route::get("dich-vu","PageController@getService")->name('web.page.service');
    Route::post("phap-ly-bds","PageController@postphaplyBDS")->name('web.page.service.phaplyBDS');
    Route::post("tham-dinh-bds","PageController@postphaplyBDS")->name('web.page.service.thamdinhBDS');
    Route::post("dam-bao-tt-nn","PageController@postthutucvahosoBDS")->name('web.page.service.thutucvahosoBDS');
    Route::post("thu-tuc-va-hoso-bds","PageController@postdambaoTTNN")->name('web.page.service.dambaoTTNN');
});
Route::group(['prefix' => 'page'], function () {
    Route::get("{slug?}","PageController@getPgae")->name('web.page.index');
});
Route::group(['prefix' => 'tin-tuc'], function () {
    Route::get("tim-kiem","NewsController@getSearch")->name('web.news.search');
});
Route::group(['prefix' => 'tin-tuc'], function () {
    Route::get("/","NewsController@getNewsIndex")->name('web.news.index');
    Route::any("{slug1?}/{slug2?}/{slug3?}","NewsController@getPost")->name('web.news.news');
});
Route::group(['prefix' => 'gui-bat-dong-san','middleware'=>['CheckAuthWeb']], function () {
    Route::get("/","RealestateController@getRealestateSend")->name('web.realestate.send');
    Route::post("ajax","RealestateController@postRealestateAjaxSend")->name('web.realestate.ajaxSend');
    Route::post("realestate-save-ajax","RealestateController@postRealestateAjaxSave")->name('web.realestate.save');

});
/*TRAO DOI */
Route::group(['prefix' => 'trao-doi-nha-dat','middleware'=>['CheckAuthWeb']], function () {
    Route::get("/","RealestateController@getTrans")->name('web.traodoinhadat');
    Route::post("getinfo","RealestateController@getInfo")->name('web.infotrans');
    Route::post("ajax","RealestateController@postRealestateAjaxTrans")->name('web.realestate.ajaxtrans');
    //tin tuc trao doi
});
Route::get("danh-sach-bds-trao-doi","RealestateController@viewDanhSachTrans")->name('traodoinhadat.tintuc');
/* */
Route::group(['prefix' => 'taikhoan','middleware'=>['CheckAuthWeb']], function () {
    Route::get("ho-so","AccountController@getIndex")->name('web.account.hoso');
    Route::get("tin-da-gui","AccountController@getTinDaGui")->name('web.account.tindagui');
    Route::get("tin-da-duyet","AccountController@getTinDaDuyet")->name('web.account.tindaduyet');
    Route::get("tin-trao-doi","AccountController@getTinTraoDoi")->name('web.account.tintraodoi');
    Route::get("tin-da-luu","AccountController@getTinDaLuu")->name('web.account.tindaluu');
    Route::get("doi-mat-khau","AccountController@getDoiMatKhau")->name('web.account.doimatkhau');
    Route::get("lien-he-admin","AccountController@getLienHe")->name('web.account.lienhe');

    Route::post("update","AccountController@postUpdateProfile")->name('web.account.update');
    Route::post("changePass","AccountController@postChangePassword")->name('web.account.changePass');
    Route::post("xoa-tin-da-gui","AccountController@deleteTinDaGui")->name('web.account.deleteTinDaGui');
    Route::post("xoa-tin-trao-doi","AccountController@deleteTinTraoDoi")->name('web.account.deleteTinTraoDoi');
    Route::post("xoa-tin-da-luu","AccountController@deleteTinDaLuu")->name('web.account.deleteTinDaLuu');
    Route::post("lienheadmin","AccountController@postLienHe")->name('web.account.postLienHe');


});
Route::group(['prefix' => 'social'], function () {
    Route::get('oauth/{driver}', 'SocialController@redirectToProvider')->name('web.social.oauth');
    Route::get('oauth/{driver}/callback', 'SocialController@handleProviderCallback')->name('web.social.callback');
});
Route::group(['prefix' => 'login' ], function () {
    Route::get("","LoginController@getLogin")->name('web.auth.login');
    Route::post("ajaxLogin","LoginController@ajaxLogin")->name('web.auth.ajaxLogin');
    Route::get("ajaxLogout","LoginController@getLogout")->name('web.auth.logout');
});
Route::group(['prefix' => 'register' ], function () {
    Route::post("ajaxRegister","LoginController@ajaxRegister")->name('web.auth.ajaxRegister');
});
Route::get('{slug1?}/{slug2?}/{slug3?}/{slug4?}/{slug5?}/{slug6?}', 'RealestateController@getData')->name('web.realestate.all');
