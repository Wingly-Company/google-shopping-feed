<?php

namespace Wingly\GoogleShoppingFeed;

use Illuminate\Support\ServiceProvider;

class GoogleShoppingFeedServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerViews();
    }

    public function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'google-shopping-feed');
    }
}
