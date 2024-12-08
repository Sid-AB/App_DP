<?php

namespace App\Providers;
use App\Models\Action;


use App\Models\initPort;
use App\Models\Programme;
use App\Providers\Schema;
use App\Models\SousAction;
use App\Models\Portefeuille;
use App\Models\SousProgramme;
use App\Observers\ActionObserver;
use App\Observers\InitPortObserver;
use App\Observers\SousProgObserver;
use App\Observers\ProgrammeObserver;
use Illuminate\Support\Facades\File;
use App\Observers\SousActionObserver;
use App\Observers\PortefeuilleObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Portefeuille::observe(PortefeuilleObserver::class);
        Programme::observe(ProgrammeObserver::class);
        SousProgramme::observe(SousProgObserver::class);
        initPort::observe(InitPortObserver::class);
        Action::observe(ActionObserver::class);
        SousAction::observe(SousActionObserver::class);

    }
}
