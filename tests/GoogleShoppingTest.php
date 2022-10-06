<?php

namespace Wingly\GoogleShoppingFeed\Tests;

use Wingly\GoogleShoppingFeed\GoogleShopping;

class GoogleShoppingTest extends TestCase
{
    public function test_can_register_feeds(): void
    {
        GoogleShopping::$feeds = [];

        GoogleShopping::feed('test1', 'One feed');
        GoogleShopping::feed('test2', 'Second feed');

        $this->assertEquals([
            'test1',
            'test2',
        ], array_keys(GoogleShopping::$feeds));
    }
}
