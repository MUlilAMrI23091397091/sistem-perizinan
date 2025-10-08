<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Permohonan' => 'App\Policies\PermohonanPolicy', // contoh policy
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gate untuk role Admin
        Gate::define('admin', function (User $user) {
            return $user->role === 'admin';
        });

        // Gate untuk role Penerbitan Berkas
        Gate::define('penerbitan_berkas', function (User $user) {
            return in_array($user->role, ['admin', 'penerbitan_berkas']);
        });

        // Gate untuk Admin atau Penerbitan Berkas
        Gate::define('admin-or-penerbitan-berkas', function (User $user) {
            return in_array($user->role, ['admin', 'penerbitan_berkas']);
        });
    }
}
