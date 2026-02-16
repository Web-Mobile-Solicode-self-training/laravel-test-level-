<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use App\Models\Goal;

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
        Paginator::defaultView('vendor.pagination.preline');
        Paginator::defaultSimpleView('vendor.pagination.preline');

        Gate::define('admin-only', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('create-goal', function (User $user) {
            return !$user->isAdmin(); // Only authors can create goals based on your snippet logic
        });

        Gate::define('edit-goal', function (User $user) {
            // Both Admins and Authors can now edit goals
            return $user->isAdmin() || $user->isAuthor();
        });

        Gate::define('delete-goal', function (User $user) {
            // Both Admins and Authors can now delete goals
            return $user->isAdmin();
        });

        // Keeping access-admin for the routes check, or mapping it to admin-only
        Gate::define('access-admin', function (User $user) {
            return $user->isAdmin() || $user->isAuthor();
        });
    }
}
