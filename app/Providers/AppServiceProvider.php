<?php

namespace App\Providers;

use App\Models\Anggota;
use App\Models\Inventaris;
use App\Models\Kegiatan;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('access-dashboard', fn (User $user) => $user->isPengurus() || $user->isAnggota());
        Gate::define('manage-anggota', fn (User $user) => $user->isPengurus());
        Gate::define('manage-inventaris', fn (User $user) => $user->isPengurus());
        Gate::define('manage-kegiatan', fn (User $user) => $user->isPengurus());
        Gate::define('manage-laporan', fn (User $user) => $user->isPengurus());
        Gate::define('manage-users', fn (User $user) => $user->isPengurus());
        Gate::define('view-gallery', fn (User $user) => $user->isPengurus() || $user->isAnggota());
        Gate::define('view-profil', fn (User $user) => $user->isPengurus() || $user->isAnggota());
        Gate::define('update-own-profile', fn (User $user) => $user->isPengurus() || $user->isAnggota());

        Gate::define('viewAny', fn (User $user, $model) => $user->isPengurus());
        Gate::define('view', fn (User $user, $model) => $user->isPengurus() || $user->isAnggota());
        Gate::define('create', fn (User $user, $model) => $user->isPengurus());
        Gate::define('update', fn (User $user, $model) => $user->isPengurus());
        Gate::define('delete', fn (User $user, $model) => $user->isPengurus());
    }
}
