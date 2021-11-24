<?php

namespace App\Providers;

use App\Models\Equipment;
use App\Models\RequestNote;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        View::composer('process_note.*', function ($view) {
            $view->with('StatusNote', RequestNote::class);
        });
        View::composer('buy_note.*', function ($view) {
            $view->with('StatusNote', RequestNote::class);
        });
        View::composer('fix_note.*', function ($view) {
            $view->with('StatusNote', RequestNote::class);
        });
        View::composer('handover_note.components.*', function ($view) {
            $view->with('StatusEquipment', Equipment::class);
        });
    }
}
