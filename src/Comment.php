<?php

namespace PluginCloud\Comment;

use Encore\Admin\Extension;

class Comment extends Extension
{
    public $name = 'comment';

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';

    public $menu = [
        'title' => 'Comment',
        'path'  => 'comment',
        'icon'  => 'fa-gears',
    ];
}