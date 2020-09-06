<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Back Web Routes

*/
Route::get('aktiv-deyil',function(){
    return view('front.offline');
});

Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function(){
Route::get('giris','Back\AuthController@login')->name('login');
Route::post('giris','Back\AuthController@loginPost')->name('login.post');
});

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function(){
Route::get('panel','Back\Dashboard@index')->name('dashboard');


// yazilarla bagli rutlar
Route::get('yazilar/silinenler','Back\ArticleController@trashed')->name('trashed.article');
Route::resource('yazilar','Back\ArticleController');
Route::get('/switch','Back\ArticleController@switch')->name('switch');
Route::get('/deletearticle/{id}','Back\ArticleController@delete')->name('delete.article');
Route::get('/harddeletearticle/{id}','Back\ArticleController@hardDelete')->name('hard.delete.article');
Route::get('/recoverarticle/{id}','Back\ArticleController@recover')->name('recover.article');
//kateqoriya rutlari
Route::get('kateqoriyalar','Back\CategoryController@index')->name('category.index');
Route::get('kateqoriyalar/status','Back\CategoryController@switch')->name('category.switch');
Route::post('kateqoriyalar/create','Back\CategoryController@create')->name('category.create');
Route::get('kateqoriyalar/getData','Back\CategoryController@getData')->name('category.getData');
Route::get('kateqoriyalar/update','Back\CategoryController@update')->name('category.update');
Route::post('kateqoriyalar/delete','Back\CategoryController@delete')->name('category.delete');
//page's route's
Route::get('sehifeler','Back\PageController@index')->name('page.index');
Route::get('/sehifeler/yarat','Back\PageController@create')->name('page.create');
Route::post('/sehifeler/yarat','Back\PageController@post')->name('page.create.post');
Route::get('/sehifeler/deyisdir/{id}','Back\PageController@update')->name('page.edit');
Route::post('/sehifeler/deyisdir/{id}','Back\PageController@updatePost')->name('page.edit.post');
Route::get('/sehifeler/sil/{id}','Back\PageController@delete')->name('page.delete');
Route::get('/sehifeler/switch','Back\PageController@switch')->name('page.switch');
Route::get('/sehifeler/siralama','Back\PageController@orders')->name('page.orders');

//
Route::get('/tenzimlemeler','Back\ConfigController@index')->name('config.index');
Route::post('/tenzimlemeler/update','Back\ConfigController@update')->name('config.update');
Route::get('cixis','Back\AuthController@logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
| Front Web Routes

*/

Route::get('/','Front\Homepage@index')->name('homepage');
Route::get('sehife','Front\Homepage@index');
Route::get('/elaqe','Front\Homepage@contact')->name('contact');
Route::post('/elaqe','Front\Homepage@contactpost')->name('contact.post');
Route::get('/kateqoriya/{category}','Front\Homepage@category')->name('category');
Route::get('/{category}/{slug}','Front\Homepage@single')->name('single');
Route::get('/{sehife}','Front\Homepage@page')->name('page');




