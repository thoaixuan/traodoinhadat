<?php
$route_login = 'wp-admin';//setting()->route_login;
$route_admin = 'icpanel';//setting()->route_admin;
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

Route::get("forgot","LoginController@forgot")->name('admin.forgot.index');
Route::post("forgot","LoginController@postForgot")->name('admin.forgot.index');
Route::get("change-password","LoginController@getChangePassWord")->name('admin.forgot.changePassWord');
Route::post("change-password","LoginController@postChangePassWord")->name('admin.forgot.changePassWord');
Route::get($route_login,"LoginController@getLogin")->name('admin.auth.login');
Route::post($route_login,"LoginController@ajaxLogin")->name('admin.auth.ajaxLogin');
Route::group(['prefix' => $route_admin,'middleware'=>['CheckAuthAdmin']], function () {
    Route::get("logout","LoginController@getLogout")->name('admin.auth.logout');
    Route::group(['prefix' => '/'], function () {
        Route::get("/","DashboardController@index")->name('admin.dashboard.view');
    });
    Route::group(['prefix' => 'area'], function () {
        Route::group(['prefix' => 'province'], function () {
            Route::get("list","AreaController@getProvinceList")->name('admin.province.view')->middleware('CheckPermission:area.view');
            Route::post("add","AreaController@postProvinceAdd")->name('admin.province.add')->middleware('CheckPermission:area.add');
            Route::get("add","AreaController@getProvinceAdd")->name('admin.province.add')->middleware('CheckPermission:area.add');
            Route::post("edit","AreaController@postProvinceEdit")->name('admin.province.edit')->middleware('CheckPermission:area.edit');
            Route::get("edit/{id?}","AreaController@getProvinceEdit")->name('admin.province.edit')->middleware('CheckPermission:area.edit');
            Route::post("delete","AreaController@delete")->name('admin.province.delete')->middleware('CheckPermission:area.delete');
        });
        Route::group(['prefix' => 'district'], function () {
            Route::get("list","AreaController@getDistrictList")->name('admin.district.view')->middleware('CheckPermission:area.view');
            Route::post("add","AreaController@postDistrictAdd")->name('admin.district.add')->middleware('CheckPermission:area.add');
            Route::get("add","AreaController@getDistrictAdd")->name('admin.district.add')->middleware('CheckPermission:area.add');
            Route::post("edit","AreaController@postDistrictEdit")->name('admin.district.edit')->middleware('CheckPermission:area.edit');
            Route::get("edit/{id?}","AreaController@getDistrictEdit")->name('admin.district.edit')->middleware('CheckPermission:area.edit');
            Route::post("delete","AreaController@delete")->name('admin.district.delete')->middleware('CheckPermission:area.delete');
        });
        Route::group(['prefix' => 'ward'], function () {
            Route::get("list","AreaController@getWardList")->name('admin.ward.view')->middleware('CheckPermission:area.view');
            Route::post("add","AreaController@postWardAdd")->name('admin.ward.add')->middleware('CheckPermission:area.add');
            Route::get("add","AreaController@getWardAdd")->name('admin.ward.add')->middleware('CheckPermission:area.add');
            Route::post("edit","AreaController@postWardEdit")->name('admin.ward.edit')->middleware('CheckPermission:area.edit');
            Route::get("edit/{id?}","AreaController@getWardEdit")->name('admin.ward.edit')->middleware('CheckPermission:area.edit');
            Route::post("delete","AreaController@delete")->name('admin.ward.delete')->middleware('CheckPermission:area.delete');
        });
        Route::post("add","AreaController@postAdd")->name('admin.area.add')->middleware('CheckPermission:area.add');
        Route::post("edit","AreaController@postEdit")->name('admin.area.edit')->middleware('CheckPermission:area.edit');
        Route::get("add/{type?}","AreaController@add")->name('admin.area.add')->middleware('CheckPermission:area.add');
        Route::get("edit/{type?}/{id?}","AreaController@edit")->name('admin.area.edit')->middleware('CheckPermission:area.edit');
    });
    Route::group(['prefix' => '/category'], function () {
        Route::group(['prefix' => 'parent'], function () {
            Route::get("/","CategoryController@getParentCategpry")->name('admin.category.parent.view')->middleware('CheckPermission:category.view');
            Route::get("datatable","CategoryController@getParentDatatable")->name('admin.category.parent.datatable');
            Route::get("edit","CategoryController@getParentEdit")->name('admin.category.parent.edit')->middleware('CheckPermission:category.edit');
            Route::post("edit","CategoryController@postParentEdit")->name('admin.category.parent.edit')->middleware('CheckPermission:category.edit');
            Route::post("add","CategoryController@postParentAdd")->name('admin.category.parent.add')->middleware('CheckPermission:category.add');
            Route::post("delete","CategoryController@postParentDelete")->name('admin.category.parent.delete')->middleware('CheckPermission:category.delete');
        });
        Route::group(['prefix' => 'sub'], function () {
            Route::get("/","CategoryController@getSubCategory")->name('admin.category.sub.view')->middleware('CheckPermission:category.view');
            Route::get("datatable","CategoryController@getSubDatatable")->name('admin.category.sub.datatable');
            Route::get("edit","CategoryController@getSubEdit")->name('admin.category.sub.edit')->middleware('CheckPermission:category.edit');
            Route::post("edit","CategoryController@postSubEdit")->name('admin.category.sub.edit')->middleware('CheckPermission:category.edit');
            Route::post("add","CategoryController@postSubAdd")->name('admin.category.sub.add')->middleware('CheckPermission:category.add');
            Route::post("delete","CategoryController@postSubDelete")->name('admin.category.sub.delete')->middleware('CheckPermission:category.delete');
        });
    });
    Route::group(['prefix' => 'news'], function () {
        Route::post("add","NewsController@newsAdd")->name('admin.news.add')->middleware('CheckPermission:news.add');
        Route::post("edit","NewsController@newsEdit")->name('admin.news.edit')->middleware('CheckPermission:news.edit');
        Route::post("delete","NewsController@newsDelete")->name('admin.news.delete')->middleware('CheckPermission:news.delete');
        Route::get("add","NewsController@getAdd")->name('admin.news.add')->middleware('CheckPermission:news.add');
        Route::get("edit/{id?}","NewsController@getEdit")->name('admin.news.edit')->middleware('CheckPermission:news.edit');
        Route::get("list","NewsController@getNewsList")->name('admin.news.view')->middleware('CheckPermission:news.view');
        Route::post("postStatusHot","NewsController@postStatusHot")->name('admin.news.postStatusHot');

    });
    Route::group(['prefix' => 'realestate'], function () {
        Route::get("tin-trao-doi","RealestateController@getAddTransList")->name('admin.realestate.trans');
        Route::post("xoa-tin-trans","RealestateController@deleteTinTraoDoi")->name('admin.deleteTinTraoDoi');
        //Route::post("tin-trao-doi","RealestateController@getAddTransByID")->name('admin.realestate.transbyid');

        Route::post("add","RealestateController@Add")->name('admin.realestate.add')->middleware('CheckPermission:realestate.add');
        Route::post("edit","RealestateController@Edit")->name('admin.realestate.edit')->middleware('CheckPermission:realestate.edit');
        Route::post("delete","RealestateController@Delete")->name('admin.realestate.delete')->middleware('CheckPermission:realestate.delete');
        Route::post("editReceived","RealestateController@editReceived")->name('admin.realestate.editReceived')->middleware('CheckPermission:realestate.received');


        Route::get("add","RealestateController@getAdd")->name('admin.realestate.add')->middleware('CheckPermission:realestate.add');

        Route::get("list","RealestateController@getList")->name('admin.realestate.view')->middleware('CheckPermission:realestate.view');
        Route::get("list-received","RealestateController@getListReceived")->name('admin.realestate.received')->middleware('CheckPermission:realestate.view');

        Route::get("edit/{id?}","RealestateController@getEdit")->name('admin.realestate.edit')->middleware('CheckPermission:realestate.edit');
        Route::get("edit-received/{id?}","RealestateController@getEdit")->name('admin.realestate.received.edit')->middleware('CheckPermission:realestate.edit');
    });
    Route::group(['prefix' => 'contact'], function () {
        Route::get("list","ContactController@getList")->name('admin.contact.view')->middleware('CheckPermission:contact.view');
        Route::post("delete","ContactController@postDelete")->name('admin.contact.delete')->middleware('CheckPermission:contact.delete');
        Route::post("status","ContactController@postStatus")->name('admin.contact.status');
    });
    Route::group(['prefix' => 'subscribe'], function () {
        Route::get("list","SubscribeController@getList")->name('admin.subscribe.view')->middleware('CheckPermission:subscribe.view');
        Route::post("delete","SubscribeController@postDelete")->name('admin.subscribe.delete')->middleware('CheckPermission:subscribe.delete');
    });
    Route::group(['prefix' => 'sitemap'], function () {
        Route::get("/","SitemapController@getIndex")->name('admin.sitemap.view')->middleware('CheckPermission:sitemap.view');
        Route::post("update","SitemapController@postUpdate")->name('admin.sitemap.update')->middleware('CheckPermission:sitemap.update');
        Route::get("dowload","SitemapController@getDowload")->name('admin.sitemap.dowload');
    });
    Route::group(['prefix' => 'page'], function () {
        Route::get("list","PageController@getList")->name('admin.page.view')->middleware('CheckPermission:page.view');
        Route::post("add","PageController@postAdd")->name('admin.page.add')->middleware('CheckPermission:page.add');
        Route::get("add","PageController@getAdd")->name('admin.page.add')->middleware('CheckPermission:page.add');
        Route::post("edit","PageController@postEdit")->name('admin.page.edit')->middleware('CheckPermission:page.edit');
        Route::get("edit/{id?}","PageController@getEdit")->name('admin.page.edit')->middleware('CheckPermission:page.edit');
        Route::post("delete","PageController@postDelete")->name('admin.page.delete')->middleware('CheckPermission:page.delete');
        Route::post("status","PageController@postStatus")->name('admin.page.status')->middleware('CheckPermission:page.edit');
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get("list","UserController@getList")->name('admin.user.view')->middleware('CheckPermission:user.view');
        Route::post("add","UserController@postAdd")->name('admin.user.add')->middleware('CheckPermission:user.add');
        Route::get("add","UserController@getAdd")->name('admin.user.add')->middleware('CheckPermission:user.add');
        Route::post("edit","UserController@postEdit")->name('admin.user.edit')->middleware('CheckPermission:user.edit');
        Route::get("edit/{id?}","UserController@getEdit")->name('admin.user.edit')->middleware('CheckPermission:user.edit');
        Route::post("delete","UserController@postDelete")->name('admin.user.delete')->middleware('CheckPermission:user.delete');
        Route::post("status","UserController@postStatus")->name('admin.user.status')->middleware('CheckPermission:user.edit');
    });
    Route::group(['prefix' => 'role'], function () {
        Route::get("list","RoleController@getList")->name('admin.role.view')->middleware('CheckPermission:role.view');
        Route::post("add","RoleController@postAdd")->name('admin.role.add')->middleware('CheckPermission:role.add');
        Route::get("add","RoleController@getAdd")->name('admin.role.add')->middleware('CheckPermission:role.add');
        Route::post("edit","RoleController@postEdit")->name('admin.role.edit')->middleware('CheckPermission:role.edit');
        Route::get("edit/{id?}","RoleController@getEdit")->name('admin.role.edit')->middleware('CheckPermission:role.edit');
        Route::post("delete","RoleController@postDelete")->name('admin.role.delete')->middleware('CheckPermission:role.delete');
        Route::post("status","RoleController@postStatus")->name('admin.role.status')->middleware('CheckPermission:role.edit');
    });
    Route::group(['prefix' => 'setting'], function () {
        Route::get("/","SettingController@getSetting")->name('admin.setting.view')->middleware('CheckPermission:setting.view');
        Route::post("edit","SettingController@postEdit")->name('admin.setting.edit')->middleware('CheckPermission:setting.edit');
    });
    Route::group(['prefix' => 'slider'], function () {
        Route::post("add","SliderController@postAdd")->name('admin.slider.add')->middleware('CheckPermission:slider.add');
        Route::post("edit","SliderController@postEdit")->name('admin.slider.edit')->middleware('CheckPermission:slider.edit');
        Route::post("status","SliderController@postStatus")->name('admin.slider.status')->middleware('CheckPermission:slider.status');
        Route::post("delete","SliderController@postDelete")->name('admin.slider.delete')->middleware('CheckPermission:slider.delete');
        Route::get("/","SliderController@getList")->name('admin.slider.view')->middleware('CheckPermission:slider.view');
        Route::get("add","SliderController@getAdd")->name('admin.slider.add')->middleware('CheckPermission:slider.add');
        Route::get("edit/{id?}","SliderController@getEdit")->name('admin.slider.edit')->middleware('CheckPermission:slider.edit');
    });
});


Route::group(['prefix' => 'sitemap'], function () {
    Route::get("show","SitemapController@showSitemap")->name('admin.sitemap.show');
    Route::get("cron-job","SitemapController@cronjobUpdate")->name('admin.sitemap.cronjobUpdate');
});
Route::get("districtAjax","AreaController@districtAjax")->name('admin.area.districtAjax');
Route::get("wardAjax","AreaController@wardAjax")->name('admin.area.wardAjax');
