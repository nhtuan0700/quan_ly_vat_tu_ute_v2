<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Role\RoleInterface;
use App\Repositories\User\UserInterface;
use App\Repositories\Role\RoleRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\DetailBuy\DetailBuyInterface;
use App\Repositories\DetailFix\DetailFixInterface;
use App\Repositories\Equipment\EquipmentInterface;
use App\Repositories\DetailBuy\DetailBuyRepository;
use App\Repositories\DetailFix\DetailFixRepository;
use App\Repositories\Equipment\EquipmentRepository;
use App\Repositories\Department\DepartmentInterface;
use App\Repositories\Stationery\StationeryInterface;
use App\Repositories\Stationery\StationeryRepository;
use App\Repositories\RequestNote\RequestNoteInterface;
use App\Repositories\RequestNote\RequestNoteRepository;
use App\Repositories\Registration\RegistrationInterface;
use App\Repositories\StationLimit\StationLimitInterface;
use App\Repositories\Registration\RegistrationRepository;
use App\Repositories\StationeryLimit\StationeryLimitRepository;
use App\Repositories\PeriodRegistraion\PeriodRegistraionInterface;
use App\Repositories\PeriodRegistraion\PeriodRegistraionRepository;

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
        $this->app->bind(DepartmentInterface::class, DepartmentRepository::class);
        $this->app->bind(StationeryInterface::class, StationeryRepository::class);
        $this->app->bind(EquipmentInterface::class, EquipmentRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(PeriodRegistraionInterface::class, PeriodRegistraionRepository::class);
        $this->app->bind(StationLimitInterface::class, StationeryLimitRepository::class);
        $this->app->bind(RegistrationInterface::class, RegistrationRepository::class);
        $this->app->bind(RequestNoteInterface::class, RequestNoteRepository::class);
        $this->app->bind(DetailBuyInterface::class, DetailBuyRepository::class);
        $this->app->bind(DetailFixInterface::class, DetailFixRepository::class);
    }
}
