<?php

namespace App\Providers;

use App\Models\Pegawai;
use App\Policies\PegawaiPolicy;
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
        //menghubungkan model pegawai dengan PegawiPolicy
        Gate::policy(Pegawai::class, PegawaiPolicy::class);
    }
}
