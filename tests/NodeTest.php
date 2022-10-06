<?php

namespace Wingly\GoogleShoppingFeed\Tests;

use Wingly\GoogleShoppingFeed\GoogleShopping;
use Wingly\GoogleShoppingFeed\Node;

class NodeTest extends TestCase
{
    public function test_it_renders_the_correct_output(): void
    {
        $node = Node::make('title', 'My title');

        $this->assertEquals(
            '<g:title>My title</g:title>',
            $node->output()
        );
    }

    public function test_it_can_conditionally_wrap_the_value_in_cdata(): void
    {
        $node = Node::make('title', 'My title')->cdata();

        $this->assertEquals(
            '<g:title><![CDATA[My title]]></g:title>',
            $node->output()
        );
    }
}
