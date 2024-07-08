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
        //
    // Fetch the records safely
$app_name_record = System::where('meta_name', 'app_name')->first();
$app_version_record = System::where('meta_name', 'app_version')->first();
$app_logo_record = System::where('meta_name', 'app_logo')->first();

// Set the values, defaulting to an empty string if the record is null
$app_name = $app_name_record ? $app_name_record->meta_value : '';
$app_version = $app_version_record ? $app_version_record->meta_value : '';
$app_logo = $app_logo_record ? $app_logo_record->meta_value : '';

// Prepare the data array
$data = [
    'app_name' => $app_name,
    'app_version' => $app_version,
    'app_logo' => $app_logo,
];

        View::share('appData', $data);
    }
} 