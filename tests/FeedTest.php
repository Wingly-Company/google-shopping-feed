<?php

namespace Wingly\GoogleShoppingFeed\Tests;

use Wingly\GoogleShoppingFeed\GoogleShopping;

class FeedTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        GoogleShopping::feed('products', 'Product feed')
            ->description('Product feed description')
            ->link('https://www.store.com/')
            ->feedItems(fn () => DummyRepository::all())
            ->toFeedItem(new DummyItem());
    }

    public function test_all_feed_items_have_expected_data(): void
    {
        $contents = GoogleShopping::findFeed('products')
            ->toXml();

        $this->assertMatchesSnapshot($contents);
    }
}
