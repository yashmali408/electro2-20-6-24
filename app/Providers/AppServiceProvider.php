<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\System;


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
        
    
        $app_name = System::where('meta_name', 'app_name')->first()->meta_value;
        $app_version = System::where('meta_name', 'app_version')->first()->meta_value;
        $app_logo = System::where('meta_name', 'app_logo')->first()->meta_value;
        $customer_care_no1 = System::where('meta_name', 'customer_care_no1')->first()->meta_value;
        $customer_care_no2 = System::where('meta_name', 'customer_care_no2')->first()->meta_value;
        $store_contact_info = System::where('meta_name', 'store_contact_info')->first()->meta_value;

        $data = [
            'app_name' =>  "$app_name",
            'app_version' => "$app_version",
            'app_logo' => "$app_logo",
            'customer_care_no1' => "$customer_care_no1",
            'customer_care_no2' => "$customer_care_no2",
            'store_contact_info' => "$store_contact_info"
        ];
    
        View::share('appData', $data);
    }
}