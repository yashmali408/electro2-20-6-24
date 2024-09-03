<?php

namespace App\Providers;


use App\View\Composers\CartComposer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use App\Models\SystemInfo;
use App\Models\Cart;


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
        // Using class based composers...
        View::composer('*', CartComposer::class);

        //How to share data globaly on all view
        //$userId= Auth::id();;
        
        //dd($userId);
        // $app_name = SystemInfo::where('meta_name', 'app_name')->first()->meta_value;
        // $app_description = SystemInfo::where('meta_name', 'app_description')->first()->meta_value;
        // $app_shortcut_icon_url = SystemInfo::where('meta_name', 'app_shortcut_icon_url')->first()->meta_value;

        // $app_version = SystemInfo::where('meta_name', 'app_version')->first()->meta_value;
        // $app_logo = SystemInfo::where('meta_name', 'app_logo')->first()->meta_value;
        // $customer_care_no1 = SystemInfo::where('meta_name', 'customer_care_no1')->first()->meta_value;
        // $customer_care_no2 = SystemInfo::where('meta_name', 'customer_care_no2')->first()->meta_value;
        // $store_contact_info = SystemInfo::where('meta_name', 'store_contact_info')->first()->meta_value;
        // $support_email_addr = SystemInfo::where('meta_name', 'support_email_addr')->first()->meta_value;
        
        // $social_fb_url = SystemInfo::where('meta_name', 'social_fb_url')->first()->meta_value;
        // $social_google_url = SystemInfo::where('meta_name', 'social_google_url')->first()->meta_value;
        // $social_x_url = SystemInfo::where('meta_name', 'social_x_url')->first()->meta_value;
        // $social_github_url = SystemInfo::where('meta_name', 'social_github_url')->first()->meta_value;

        
        // //dd(Auth::id());
        // $data = [
        //     'app_name' => $app_name,
        //     'app_description' => $app_description,
        //     'app_shortcut_icon_url' => $app_shortcut_icon_url,
        //     'app_version' => $app_version,
        //     'app_logo' => $app_logo,
        //     'customer_care_no1' => $customer_care_no1,
        //     'customer_care_no2' => $customer_care_no2,
        //     'store_contact_info' => $store_contact_info,
        //     'support_email_addr' => $support_email_addr,

        //     'social_fb_url' => $social_fb_url,
        //     'social_google_url' => $social_google_url,
        //     'social_x_url' => $social_x_url,
        //     'social_github_url' => $social_github_url,


        //     /* 'cart_info' => [
        //         'cart_count' => $cartCount,
        //         'cart_total' => $grandTotal,
        //     ], */
        // ]; 
        // //ClassName::method(aa1,aa2)
        // View::share('appData', $data);
    }
}