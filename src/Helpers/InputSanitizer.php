<?php

namespace Wingly\GoogleShoppingFeed\Helpers;

class InputSanitizer
{
    public static function sanitize(string $input): string
    {
        // Replace Single Curly Quotes
        $search[] = chr(226).chr(128).chr(152);
        $replace[] = "'";
        $search[] = chr(226).chr(128).chr(153);
        $replace[] = "'";

        // Replace Smart Double Curly Quotes
        $search[] = chr(226).chr(128).chr(156);
        $replace[] = '"';
        $search[] = chr(226).chr(128).chr(157);
        $replace[] = '"';

        // Replace En Dash
        $search[] = chr(226).chr(128).chr(147);
        $replace[] = '--';

        // Replace Em Dash
        $search[] = chr(226).chr(128).chr(148);
        $replace[] = '---';

        // Replace Bullet
        $search[] = chr(226).chr(128).chr(162);
        $replace[] = '*';

        // Replace Middle Dot
        $search[] = chr(194).chr(183);
        $replace[] = '*';

        // Replace Ellipsis with three consecutive dots
        $search[] = chr(226).chr(128).chr(166);
        $replace[] = '...';

        // Apply Replacements
        $input = str_replace($search, $replace, $input);

        // Remove any non-ASCII Characters
        $input = preg_replace("/[^\x20-\x7E]/u", '', $input);

        return $input;
    }
}
