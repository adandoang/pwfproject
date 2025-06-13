<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Auth::provider('admins', function ($app, array $config) {
            return $app['auth'] instanceof \Illuminate\Auth\AuthManager
                ? $app['auth']->createEloquentProvider($config)
                : new \Illuminate\Auth\EloquentUserProvider($app['hash'], $config['model']);
        });
    }
}
