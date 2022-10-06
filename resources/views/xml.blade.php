<?=
    /* Using an echo tag here so the `<? ... ?>` won't get parsed as short tags */
    '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>

<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">
    <channel>
        <title>{{ $title }}</title>
        <link>{{ $link }}</link>
        <description>{{ $description }}</description>
        @foreach($items as $item)
            <item>
                @foreach ($item as $node)
                    {!! $node !!}
                @endforeach
            </item>
        @endforeach
    </channel>
</rss>


