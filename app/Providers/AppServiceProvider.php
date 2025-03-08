<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

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
        // Ensure session is started before setting locale
        if (!session()->has('locale')) {
            session(['locale' => 'en']); // Default to English
        }

        App::setLocale(session('locale'));

        // Define font based on locale
        $khmerFont = App::getLocale() === 'km' ? 'khmer os siemreap' : 'Roboto, sans-serif';

        // Share the font variable with all Blade views
        View::share('khmerFont', $khmerFont);
    }
}
