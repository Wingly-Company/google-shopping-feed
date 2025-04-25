<?php

namespace Wingly\GoogleShoppingFeed;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

class Feed implements Responsable
{
    protected string $description = '';

    protected string $link = '';

    /** @var callable(\Illuminate\Database\Eloquent\Model):array<int, Node> */
    public $nodesCallback;

    /** @param callable():\Illuminate\Support\Collection $callback */
    public $feedItemsCallback;

    public function __construct(
        protected string $name,
        protected string $title
    ) {
    }

    public function description(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function link(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @param callable(\Illuminate\Database\Eloquent\Model):array<int, Node> $callback
     */
    public function toFeedItem($callback): self
    {
        $this->nodesCallback = $callback;

        return $this;
    }

    /**
     * @param callable():\Illuminate\Support\Collection $callback
     */
    public function feedItems($callback): self
    {
        $this->feedItemsCallback = $callback;

        return $this;
    }

    public function toXml(): string
    {
        $items = call_user_func($this->feedItemsCallback)->map(function ($item) {
            return call_user_func($this->nodesCallback, $item);
        });

        $output = View::make('google-shopping-feed::xml', [
            'title' => $this->title,
            'description' => $this->description,
            'link' => $this->link,
            'items' => $items,
        ])->render();

        return $output;
    }

    public function toResponse($request): Response
    {
        $contents = $this->toXml();

        return new Response($contents, 200, [
            'Content-Type' => 'application/xml;charset=UTF-8',
        ]);
    }
}
