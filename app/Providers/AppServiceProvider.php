<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Gates
        Gate::define('admin', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-listing', function (User $user, $listing) {
            return $user->id === $listing->user_id || $user->role === 'admin';
        });

        Gate::define('manage-product', function (User $user, $product) {
            return $user->id === $product->user_id || $user->role === 'admin';
        });

        Gate::define('manage-service', function (User $user, $service) {
            return $user->id === $service->user_id || $user->role === 'admin';
        });
    }
}
