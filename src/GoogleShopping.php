<?php

namespace Wingly\GoogleShoppingFeed;

class GoogleShopping
{
    public static array $feeds = [];

    public static function feed(string $name, string $title)
    {
        return tap(new Feed($name, $title), function ($feed) use ($name) {
            static::$feeds[$name] = $feed;
        });
    }

    public static function findFeed(string $name)
    {
        return static::$feeds[$name] ?? null;
    }
}
