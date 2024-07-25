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
        //How to share data globaly on all view
    
        $app_name = System::where('meta_name', 'app_name')->first()->meta_value;
        $app_description = System::where('meta_name', 'app_description')->first()->meta_value;
        $app_shortcut_icon_url = System::where('meta_name', 'app_shortcut_icon_url')->first()->meta_value;

        $app_version = System::where('meta_name', 'app_version')->first()->meta_value;
        $app_logo = System::where('meta_name', 'app_logo')->first()->meta_value;
        $customer_care_no1 = System::where('meta_name', 'customer_care_no1')->first()->meta_value;
        $customer_care_no2 = System::where('meta_name', 'customer_care_no2')->first()->meta_value;
        $store_contact_info = System::where('meta_name', 'store_contact_info')->first()->meta_value;
        $support_email_addr = System::where('meta_name', 'support_email_addr')->first()->meta_value;
        
        $social_fb_url = System::where('meta_name', 'social_fb_url')->first()->meta_value;
        $social_google_url = System::where('meta_name', 'social_google_url')->first()->meta_value;
        $social_x_url = System::where('meta_name', 'social_x_url')->first()->meta_value;
        $social_github_url = System::where('meta_name', 'social_github_url')->first()->meta_value;

        $data = [
            'app_name' => $app_name,
            'app_description' => $app_description,
            'app_shortcut_icon_url' => $app_shortcut_icon_url,
            'app_version' => $app_version,
            'app_logo' => $app_logo,
            'customer_care_no1' => $customer_care_no1,
            'customer_care_no2' => $customer_care_no2,
            'store_contact_info' => $store_contact_info,
            'support_email_addr' => $support_email_addr,

            'social_fb_url' => $social_fb_url,
            'social_google_url' => $social_google_url,
            'social_x_url' => $social_x_url,
            'social_github_url' => $social_github_url
        ]; 
        //ClassName::method(aa1,aa2)
        View::share('appData', $data);
    }
}