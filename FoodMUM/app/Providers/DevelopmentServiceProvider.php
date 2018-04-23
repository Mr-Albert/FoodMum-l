<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class DevelopmentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        if (env("APP_ENV", "null") == "local") {
            DB::listen(
                function ($query) {
                    Log::debug("Query : " . (string) $query->sql . " ,{Bindings: [ " . implode($query->bindings, " ,") . " ] ,Time: " . ($query->time) . " }");
                }
            );
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
