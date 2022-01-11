<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/', function () {
        return view('index');
    });
    Route::get('/dangky', function () {
        return view('register');
    })->middleware('login');
    Route::get('/dangnhap', function () {
        return view('login');
    })->middleware('login');
    Route::post('dangnhap', 'AuthController@login')->name('login');
    Route::post('dangky', 'AuthController@register')->name('register');
    Route::get('dangxuat', 'AuthController@logout')->name('logout');
});



// Admin
Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['admin']], function () {

    Route::get('/', 'HomeController@index')->name('adminpage');

    //user
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {

        //doi mat khau
        Route::get('/doi-mat-khau/{id}', 'UserController@doi_mat_khau_form')->name('doi-mat-khau-form');
        Route::put('/doi-mat-khau/{id}', 'UserController@doi_mat_khau')->name('doi-mat-khau');


        Route::get('/', 'UserController@index')->name('index');
        Route::delete('/{id}', 'UserController@destroy')->name('destroy');
        Route::get('/create', 'UserController@create')->name('create');
        Route::post('/store', 'UserController@store')->name('store');
        Route::get('/edit/{id}', 'UserController@edit')->name('edit');
        Route::put('/edit/{id}', 'UserController@update')->name('update');
        Route::delete('/delete/{id}', 'UserController@destroy')->name('destroy');
        Route::get('/xoa-nhieu-nguoi-dung', 'UserController@destroyAll')->name('destroyAll');
        Route::get('/search', 'UserController@search')->name('search');
        Route::get('/thung-rac', 'UserController@trash')->name('trash');
        Route::get('/khoi-phuc/{id}', 'UserController@unTrash')->name('unTrash');
        Route::delete('/xoa-vinh-vien/{id}', 'UserController@forceDelete')->name('forceDelete');
        Route::get('/xoa-vinh-vien', 'UserController@forceDeleteAll')->name('forceDeleteAll');
        Route::get('/khoi-phuc-nguoi-dung', 'UserController@restore')->name('restore');
    });

    //sanpham
    Route::group(['prefix' => 'sanpham', 'as' => 'sanpham.'], function () {
        Route::get('/', 'SanPhamController@index')->name('index');
        Route::get('/show/{id}', 'SanPhamController@show')->name('show');
        Route::get('/create', 'SanPhamController@create')->name('create');
        Route::post('/store', 'SanPhamController@store')->name('store');
        Route::get('/edit/{id}', 'SanPhamController@edit')->name('edit');
        Route::put('/edit/{id}', 'SanPhamController@update')->name('update');
        Route::delete('/delete/{id}', 'SanPhamController@destroy')->name('destroy');
        Route::get('/xoa-nhieu-san-pham', 'SanPhamController@destroyAll')->name('destroyAll');
        Route::get('/search', 'SanPhamController@search')->name('search');
        Route::get('/thung-rac', 'SanPhamController@trash')->name('trash');
        Route::get('/khoi-phuc/{id}', 'SanPhamController@unTrash')->name('unTrash');
        Route::delete('/xoa-vinh-vien/{id}', 'SanPhamController@forceDelete')->name('forceDelete');
        Route::get('/xoa-vinh-vien', 'SanPhamController@forceDeleteAll')->name('forceDeleteAll');
        Route::get('/khoi-phuc-san-pham', 'SanPhamController@restore')->name('restore');
    });

    //danhmuc
    Route::group(['prefix' => 'danhmuc', 'as' => 'danhmuc.'], function () {
        Route::get('', 'DanhMucController@index')->name('index');
        Route::get('/show/{id}', 'DanhMucController@show')->name('show');
        Route::get('/create', 'DanhMucController@create')->name('create');
        Route::post('/store', 'DanhMucController@store')->name('store');
        Route::get('/edit/{id}', 'DanhMucController@edit')->name('edit');
        Route::put('/edit/{id}', 'DanhMucController@update')->name('update');
        Route::delete('/delete/{id}', 'DanhMucController@destroy')->name('destroy');
        Route::get('/xoa-nhieu-danh-muc', 'DanhMucController@destroyAll')->name('destroyAll');
        Route::get('/search', 'DanhMucController@search')->name('search');
        Route::get('/thung-rac', 'DanhMucController@trash')->name('trash');
        Route::get('/khoi-phuc/{id}', 'DanhMucController@unTrash')->name('unTrash');
        Route::delete('/xoa-vinh-vien/{id}', 'DanhMucController@forceDelete')->name('forceDelete');
        Route::get('/xoa-vinh-vien', 'DanhMucController@forceDeleteAll')->name('forceDeleteAll');
        Route::get('/khoi-phuc-danh-muc', 'DanhMucController@restore')->name('restore');
    });

    //blog
    Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
        Route::get('/', 'BlogController@index')->name('index');
        Route::get('/show/{id}', 'BlogController@show')->name('show');
        Route::get('/create', 'BlogController@create')->name('create');
        Route::post('/store', 'BlogController@store')->name('store');
        Route::get('/edit/{id}', 'BlogController@edit')->name('edit');
        Route::put('/edit/{id}', 'BlogController@update')->name('update');
        Route::delete('/delete/{id}', 'BlogController@destroy')->name('destroy');
        Route::get('/xoa-nhieu-san-pham', 'BlogController@destroyAll')->name('destroyAll');
        Route::get('/search', 'BlogController@search')->name('search');
        Route::get('/thung-rac', 'BlogController@trash')->name('trash');
        Route::get('/khoi-phuc/{id}', 'BlogController@unTrash')->name('unTrash');
        Route::delete('/xoa-vinh-vien/{id}', 'BlogController@forceDelete')->name('forceDelete');
        Route::get('/xoa-vinh-vien', 'BlogController@forceDeleteAll')->name('forceDeleteAll');
        Route::get('/khoi-phuc-san-pham', 'BlogController@restore')->name('restore');
    });

    //gioithieu
    Route::group(['prefix' => 'gioithieu', 'as' => 'gioithieu.'], function () {
        Route::get('/', 'GioiThieuController@index')->name('index');
        Route::get('/show/{id}', 'GioiThieuController@show')->name('show');
        Route::get('/create', 'GioiThieuController@create')->name('create');
        Route::post('/store', 'GioiThieuController@store')->name('store');
        Route::get('/edit/{id}', 'GioiThieuController@edit')->name('edit');
        Route::put('/edit/{id}', 'GioiThieuController@update')->name('update');
        Route::delete('/delete/{id}', 'GioiThieuController@destroy')->name('destroy');
        Route::get('/search', 'GioiThieuController@search')->name('search');
    });
});