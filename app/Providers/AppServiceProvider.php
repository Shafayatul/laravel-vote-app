<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

use Auth;
use App\Project;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Schema::defaultStringLength(191);

        View::composer('*', function ($view) {
            if(Auth::check()){
                $current_user = Auth::user();
                View::share('current_user', $current_user);

                $active_project_cnt = Project::where('user_id', $current_user->id)->where('stat', '2')->count();
                View::share('active_project_cnt', $active_project_cnt);
            }
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
