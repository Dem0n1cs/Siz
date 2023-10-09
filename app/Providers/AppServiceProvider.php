<?php

namespace App\Providers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
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
    public function boot()
    {
        Model::shouldBeStrict(!app()->isProduction());

        if (env('APP_ENV') === 'local') {
            DB::connection()->enableQueryLog();
            Event::listen('kernel.handled', function ($request) {
                if ($request->has('sql-debug')) {
                    $queries = DB::getQueryLog();
                    dump($queries);
                }
            });
        }
    }

}
