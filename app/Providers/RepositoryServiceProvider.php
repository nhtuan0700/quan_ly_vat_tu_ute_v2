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
use App\Repositories\Department\DepartmentRepository;
use App\Repositories\DetailHandoverBuy\DetailHandoverBuyInterface;
use App\Repositories\DetailHandoverBuy\DetailHandoverBuyRepository;
use App\Repositories\DetailHandoverFix\DetailHandoverFixInterface;
use App\Repositories\DetailHandoverFix\DetailHandoverFixRepository;
use App\Repositories\HandoverNote\HandoverNoteInterface;
use App\Repositories\HandoverNote\HandoverNoteRepository;
use App\Repositories\LimitStationery\LimitStationeryInterface;
use App\Repositories\LimitStationery\LimitStationeryRepository;
use App\Repositories\Stationery\StationeryRepository;
use App\Repositories\RequestNote\RequestNoteInterface;
use App\Repositories\RequestNote\RequestNoteRepository;
use App\Repositories\Registration\RegistrationInterface;
use App\Repositories\Registration\RegistrationRepository;
use App\Repositories\PeriodRegistration\PeriodRegistrationInterface;
use App\Repositories\PeriodRegistration\PeriodRegistrationRepository;
use App\Repositories\Position\PositionInterface;
use App\Repositories\Position\PositionRepository;

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
        $this->app->bind(PeriodRegistrationInterface::class, PeriodRegistrationRepository::class);
        $this->app->bind(LimitStationeryInterface::class, LimitStationeryRepository::class);
        $this->app->bind(RegistrationInterface::class, RegistrationRepository::class);
        $this->app->bind(RequestNoteInterface::class, RequestNoteRepository::class);
        $this->app->bind(DetailBuyInterface::class, DetailBuyRepository::class);
        $this->app->bind(DetailFixInterface::class, DetailFixRepository::class);
        $this->app->bind(HandoverNoteInterface::class, HandoverNoteRepository::class);
        $this->app->bind(DetailHandoverBuyInterface::class, DetailHandoverBuyRepository::class);
        $this->app->bind(DetailHandoverFixInterface::class, DetailHandoverFixRepository::class);
        $this->app->bind(PositionInterface::class, PositionRepository::class);
    }
}
