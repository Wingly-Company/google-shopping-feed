<?php

namespace Wingly\GoogleShoppingFeed\Tests;

class DummyRepository
{
    public static $items = [
        [
            'id' => 1,
            'title' => 'feedItemTitle',
            'description' => 'feedItemDescription',
        ],
        [
            'id' => 2,
            'title' => 'feedItemTitle',
            'description' => 'feedItemDescription',
        ],
        [
            'id' => 3,
            'title' => 'feedItemTitle',
            'description' => 'feedItemDescription',
        ],
        [
            'id' => 4,
            'title' => 'feedItemTitle',
            'description' => 'feedItemDescription',
        ],
        [
            'id' => 5,
            'title' => 'feedItemTitle',
            'description' => 'feedItemDescription',
        ],
    ];

    public static function all()
    {
        return collect(static::$items);
    }
}
