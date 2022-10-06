# GoogleShoppingFeed

## Introduction 

Register and configure XML [Google Merchant feeds](https://support.google.com/merchants/answer/7439058?hl=en) for your eloquent models.  
Once your feed is configured you can create an endpoint so Google can parse and retrieve your products.  

## Installation 

First make sure to configure the repository in your composer.json by running:

```bash
composer config repositories.google-shopping-feed vcs https://github.com/Wingly-Company/google-shopping-feed
```

Then install the package by running:

```bash
composer require wingly/google-shopping-feed
```

## Registering feeds 

You can define a feed by using the `GoogleShopping::feed` method. You would typically do this in a service provider. 
Pass a unique name for your feed and the title of the XML file. 

```php 
<?php

namespace App\Providers;

use Wingly\GoogleShoppingFeed\GoogleShopping

class GoogleShoppingFeedServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        GoogleShopping::feed('products', 'My product feed');
    }
}
```

You can also add `description` and a `link` to your feed.

```php
GoogleShopping::feed('products', 'My product feed')
    ->description('My feed description')
    ->link('https://www.store.com/');
```

## Configuring feed collections  

Imagine that you have a Product model that you want to generate a feed for. 
You should tell your feed how to retrieve the products by using the `feedItems` method. This method accepts a callback that should return a `Collection` of items.  

```php
GoogleShopping::feed('products', 'My product feed')
    ->feedItems(fn () => Product::all());
```

## Configuring feed items   

After you have configured your feed to retrieve the items you gonna have to tell it how to transform those items to proper XML nodes.
You can do that by caling the `toFeedItem` method at your feed instance. This method accepts a callback or an invokable class and should return an array of `Nodes`.

```php 
GoogleShopping::feed('products', 'My product feed')
    ->feedItems(fn () => Product::all())
    ->toFeedItem(function ($product) {
        return [
            Node::make('id', $product->id),
            Node::make('title', $product->title),
            Node::make('description', $product->description),
            Node::make('price', $product->price),
        ];
    });
```

If you have many nodes to render you can cleanup the above code by creating an invokable class

```php 
class ProductFeedItem
{
    public function __invoke($product)
    {
        return [
            Node::make('id', $product->id),
            Node::make('title', $product->title),
            Node::make('description', $product->description),
            Node::make('price', function () use ($product) {
                return $product->price . 'EUR'; 
            }),
        ];
    }
}
```

And then add it to your feed

```php
GoogleShopping::feed('products', 'My product feed')
    ->feedItems(fn () => Product::all())
    ->toFeedItem(new ProductFeedItem);
```

## Working with Nodes

`\Wingly\GoogleShoppingFeed\Node` renders it's value correctly formatted as a XML node. It accepts an attribute and a value. 
Attributes should be compatible with [Google Merchant specifications](https://support.google.com/merchants/answer/7052112?hl=en&ref_topic=6324338)

```php
Node::make('id', 1); // outputs <g:id>1</g:id>
```
You can optionally wrap your values in CDATA tags by calling the `cdata` method at the `Node` instance 

```php
Node::make('title', 'My title')->cdata(); // outputs <g:title><![CDATA[My title]]></g:title>
```

## Generating feeds

You typically would either generate your feed on the fly when Google hits your endpoint or you would generate it in the background, store it and render it later.

To generate a feed on the fly you should first grab one of your configured feeds through the `findFeed` method. Once you have retrieved your feed you can directly return it. The appopriate response content and headers will be returned. 

```php 
class GoogleFeedController extends Controller 
{
    public function __invoke(): Response
    {
        $feed = GoogleShopping::findFeed('products');

        return $feed;
    }
}
```

To generate a feed in the background you can use a scheduled command  

```php 
class GenerateProductFeedCommand extends Command
{
    public function handle(): int
    {
        $feed = GoogleShopping::findFeed('products');

        Storage::put('feed.xml', $feed->toXml());

        return 0;
    }
}
```




