<?php
return [

    'feeds' => [
        'contents' => [
            'items' => 'PluginCloud\Comment\Models\Content@getFeedItems',

            'url' => '/feed',

            'title' => 'Feed',

            /*
             * Custom view for the items.
             *
             * Defaults to feed::feed if not present.
             */
            'view' => 'feeds::feed',
        ],
    ],

];