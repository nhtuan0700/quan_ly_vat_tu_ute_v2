<?php

namespace App\Providers;

use App\Repositories\ChiTietMua\ChiTietMuaInterface;
use App\Repositories\ChiTietMua\ChiTietMuaRepository;
use App\Repositories\DangKyVanPhongPham\DangKyVanPhongPhamInterface;
use App\Repositories\DangKyVanPhongPham\DangKyVanPhongPhamRepository;
use App\Repositories\DanhMuc\DanhMucInterface;
use App\Repositories\DanhMuc\DanhMucRepository;
use App\Repositories\DonVi\DonViInterface;
use App\Repositories\DonVi\DonViRepository;
use App\Repositories\DotDangKy\DotDangKyInterface;
use App\Repositories\DotDangKy\DotDangKyRepository;
use App\Repositories\HanMuc\HanMucInterface;
use App\Repositories\HanMuc\HanMucRepository;
use App\Repositories\PhieuDeNghi\PhieuDeNghiInterface;
use App\Repositories\PhieuDenghi\PhieuDenghiRepository;
use App\Repositories\Role\RoleInterface;
use App\Repositories\Role\RoleRepository;
use App\Repositories\ThietBi\ThietBiInterface;
use App\Repositories\ThietBi\ThietBiRepository;
use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\VanPhongPham\VanPhongPhamInterface;
use App\Repositories\VanPhongPham\VanPhongPhamRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(RoleInterface::class, RoleRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(DonViInterface::class, DonViRepository::class);
        $this->app->bind(VanPhongPhamInterface::class, VanPhongPhamRepository::class);
        $this->app->bind(ThietBiInterface::class, ThietBiRepository::class);
        $this->app->bind(DanhMucInterface::class, DanhMucRepository::class);
        $this->app->bind(DotDangKyInterface::class, DotDangKyRepository::class);
        $this->app->bind(HanMucInterface::class, HanMucRepository::class);
        $this->app->bind(DangKyVanPhongPhamInterface::class, DangKyVanPhongPhamRepository::class);
        $this->app->bind(PhieuDeNghiInterface::class, PhieuDenghiRepository::class);
        $this->app->bind(ChiTietMuaInterface::class, ChiTietMuaRepository::class);
    }
}
