<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Channel;
use App\Policies\ChannelPolicy;

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
    }

    protected $policies = [
        Channel::class => ChannelPolicy::class, 
    ];
}
