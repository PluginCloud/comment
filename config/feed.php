<?php
return [

    'feeds' => [
        'news' => [
            'items' => 'PluginCloud\Comment\Models@getFeedItems',

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