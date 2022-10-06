<?php

namespace Wingly\GoogleShoppingFeed\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Wingly\GoogleShoppingFeed\GoogleShoppingFeedServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [GoogleShoppingFeedServiceProvider::class];
    }
}
