<?php

namespace Wingly\GoogleShoppingFeed\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\Snapshots\MatchesSnapshots;
use Wingly\GoogleShoppingFeed\GoogleShoppingFeedServiceProvider;

abstract class TestCase extends Orchestra
{
    use MatchesSnapshots;

    protected function getPackageProviders($app)
    {
        return [GoogleShoppingFeedServiceProvider::class];
    }
}
