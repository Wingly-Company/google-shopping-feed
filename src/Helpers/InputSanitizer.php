<?php

namespace Wingly\GoogleShoppingFeed\Helpers;

class InputSanitizer
{
    public static function sanitize(string $input): string
    {
        // Characters to be replaced with their respective XML entities
        $search = [
            '•', '”', '“', '’', '‘', '™', '®', '°', "\n",
        ];

        // XML entities to replace the characters
        $replace = [
            '&#8226;', '&#8221;', '&#8220;', '&#8217;', '&#8216;', '&trade;', '&reg;', '&deg;', '',
        ];

        // Replace special characters with their respective XML entities
        $sanitized = str_replace($search, $replace, $input);

        return $sanitized;
    }
}
