<?php

namespace App\Providers;

use App\Repositories\DanhMuc\DanhMucInterface;
use App\Repositories\DanhMuc\DanhMucRepository;
use App\Repositories\DonVi\DonViInterface;
use App\Repositories\DonVi\DonViRepository;
use App\Repositories\DotDangKy\DotDangKyInterface;
use App\Repositories\DotDangKy\DotDangKyRepository;
use App\Repositories\Role\RoleInterface;
use App\Repositories\Role\RoleRepository;
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
        $this->app->bind(DanhMucInterface::class, DanhMucRepository::class);
        $this->app->bind(DotDangKyInterface::class, DotDangKyRepository::class);
    }
}
