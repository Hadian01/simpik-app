<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Force HTTPS in production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
            
            // Create storage link if not exists (for Railway deployment)
            if (!file_exists(public_path('storage'))) {
                $this->app->make('files')->link(
                    storage_path('app/public'),
                    public_path('storage')
                );
            }
        }
    }
}
