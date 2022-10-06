<?php

namespace Wingly\GoogleShoppingFeed;

use InvalidArgumentException;
use Stringable;
use Wingly\GoogleShoppingFeed\Helpers\InputSanitizer;

class Node implements Stringable
{
    protected bool $shouldWrapValueInCDATA = false;

    protected string $value;

    public function __construct(protected string $attribute, mixed $value)
    {
        if (is_callable($value)) {
            $value = call_user_func($value);
        }

        if (! is_scalar($value)) {
            throw new InvalidArgumentException('Node value cannot be converted to a XML node');
        }

        $this->value = InputSanitizer::sanitize((string) $value);
    }

    public static function make(string $attribute, mixed $value): static
    {
        return new static($attribute, $value);
    }

    public function cdata(): self
    {
        $this->shouldWrapValueInCDATA = true;

        return $this;
    }

    public function output(): string
    {
        $value = $this->value;

        if ($this->shouldWrapValueInCDATA) {
            $value = "<![CDATA[{$value}]]>";
        }

        $output = "<g:{$this->attribute}>{$value}</g:{$this->attribute}>";

        return $output;
    }

    public function __toString(): string
    {
        return $this->output();
    }
}
