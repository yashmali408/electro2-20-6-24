<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\system;


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
        //
    
    
        $app_name = system::where('meta_name', 'app_name')->first()->meta_value;
        $app_version = system::where('meta_name', 'app_version')->first()->meta_value;
        $app_logo = system::where('meta_name', 'app_logo')->first()->meta_value;

        $data = [
            'app_name' =>  $app_name,
            'app_version' => $app_version,
            'app_logo' => $app_logo
        ];
    
        View::share('appData', $data);
    }
}