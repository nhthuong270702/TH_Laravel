<?php

namespace App\Providers;

use App\Models\DanhMuc;
use App\Models\GioiThieu;
use App\Models\SanPham;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $gioithieu = DB::table('gioi_thieu')->orderBy('id', 'DESC')->first();
        view()->share('gioithieu', $gioithieu);

        //danh muc
        $danhmucs = DanhMuc::all();
        view()->share('danhmucs', $danhmucs);

        $danhmuc5 = DB::table('danh_muc')->orderBy('id', 'desc')->take(5)->get();
        view()->share('danhmuc5', $danhmuc5);

        //blog
        $blog3 = DB::table('blogs')->orderBy('id', 'desc')->take(3)->get();
        view()->share('blog3', $blog3);

        //sanpham
        $sanpham3 = DB::table('san_pham')->orderBy('id', 'desc')->take(3)->get();
        view()->share('sanpham3', $sanpham3);

        $sanphams = SanPham::all();

        return view()->share('sanphams', $sanphams);
    }
}