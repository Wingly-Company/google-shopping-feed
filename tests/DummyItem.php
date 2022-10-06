<?php

namespace Wingly\GoogleShoppingFeed\Tests;

use Wingly\GoogleShoppingFeed\Node;

class DummyItem
{
    public function __invoke($item)
    {
        return [
            Node::make('id', $item['id']),
            Node::make('title', $item['title']),
            Node::make('description', $item['description']),
        ];
    }
}
